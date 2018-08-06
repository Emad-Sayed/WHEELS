<?php

namespace App\Http\Controllers\API;

use App\Car;
use App\rentedCar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('isAdmin');
    }*/

    function update_cars_status(){
        $rentedCars=rentedCar::all();
        $ToDayDate=new Carbon();
        foreach($rentedCars as $rentedcar){
            $endDate=$rentedcar->end_date;
            if($ToDayDate->gt($endDate)){
                $car=Car::find($rentedcar->car->id);
                $car->state=0;
                $car->save();
                $rentedcar->delete();
            }
        }
        return response()->json(['success'=>'updated'],200);
    }
    function setAvailable(Request $request){
        $car=Car::find($request->input('car_id'));
        $rented=rentedCar::select('id')->where('car_id','=',$car->id)->get();
        if(count($rented)){
            $rented[0]->delete();
        }
        $car->state=0;
        $car->save();
        return response()->json(['success'=>$car],200);
    }
    function setUnavailable(Request $request){
        $car=Car::find($request->input('car_id'));
        $car->state=1;
        $car->save();
        return response()->json(['success'=>$car],200);
    }
    function getRentedCars(){
        $rentedCars=rentedCar::all();
        return response()->json(['success'=>$rentedCars],200);
    }
    function statistics(){
        $cars=Car::all();
        $AvailableCount=0;
        $UnavailableCount=0;
        foreach($cars as $car){
            if($car->state==0)
                $AvailableCount++;
            else
                $UnavailableCount++;
        }
        $arr['Available']=$AvailableCount;
        $arr['Unavailable']=$UnavailableCount;
        return response()->json(['success'=>$arr],200);
    }
}
