<?php

namespace App\Http\Controllers\API;

use App\rentedCar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Car;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Image;

class CarController extends Controller
{

    public function index()
    {
        $cars=Car::paginate(10);
        return response ()->json(['success'=>$cars],200);
    }
    public function GetAll()
    {
        $cars=Car::all();
        return response ()->json(['success'=>$cars],200);
    }


    //Store and Update
    public function store(Request $request)
    {
        $this->validate($request,[
            'model'=>'required|min:4|max:6',
            'color'=>'required',
            'price'=>'integer|between:100,1000',
            'seats'=>'integer|between:1,8',
            'image'=>'mimes:jpeg,bmp,png,jpg',
            'category_id'=>'required'
        ]);
        $input=$request->all();
        $input['state']=0;
        $input['category_id']= Category::findorfail($request->input('category_id'))->id; //check if already exists
        if($request->has('file'))
        {
            $car_image=$request->file('file');
            $car_details_image=$request->file('file2');
            $fileName=$input['model'].$input['category_id'].'_'.'_'.$input['price'].'.'.$car_image->getClientOriginalExtension();
            Image::make($car_image)->Resize(250, 250)->save(public_path('Images/Cars/' . $fileName));
            Image::make($car_details_image)->Resize(540, 500)->save(public_path('Images/Detailed/' . $fileName));
            $input['image']=$fileName;
            if(array_key_exists('id',$input)) // Update existing Record
                $car=Car::find($input['id']);
            else
                $car=new Car();
            $car->fill($input);
            $car->save();
            return response()->json(['success'=>$car],200);
        }
        return response()->json(['error'=>"invalid Data"]);
    }

    public function show($id)
    {
        $car=Car::findorfail($id);
        $car['category_name']=$car->type->categoryName;
        return response()->json(['success'=>$car],200);
    }

    public function car_request(Request $request){
        $this->validate($request,[
            'numberOfDays'=>'integer|between:0,1000'
        ]);
        $car_id=$request->input('car_id');
        $numberOfDays=$request->input('numberOfDays');
        $car=Car::findorfail($car_id);
        if($car->state==1)
            return response()->json(['error'=>"Car Not Available"],400);
        $user=Auth::user();
        if($user->balance<($car->price*$numberOfDays))
            return response()->json(['error'=>"Balance not Enough"],400);
        $start_date=new Carbon();
        $end_date=new Carbon();
        $end_date->addDays($numberOfDays);
        $rentedCar=new rentedCar();
        $rentedCar->user_id=$user->id;
        $rentedCar->car_id=$car->id;
        $rentedCar->start_date=$start_date;
        $rentedCar->end_date=$end_date;
        $user->balance-=$car->price*$numberOfDays;
        $rentedCar->save();
        $car->state=1; // change car state to Busy
        $car->save();
        $user->save(); //after minus his balance
        return response()->json(['success'=>$rentedCar],200);
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $rented=rentedCar::select('id')->where('car_id','=',$id)->get();
        if(count($rented))
            $rented->delete();
        $car=Car::findorfail($id);
        $car->delete();
        return response()->json(['success'=>$car],200);
    }
}
