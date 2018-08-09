<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    public function cars()
    {
        return $this->hasMany('App\Car');
    }
    public function Delete(){
        $cars=$this->cars();
        foreach ($cars as $car){
            $car->Delete();
        }
        return parent::delete();
    }
}
