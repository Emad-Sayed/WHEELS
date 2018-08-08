<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table='Cars';
    protected $fillable=['model','color','numberOfSeats','price','state','image','category_id'];
    public function type()
    {
        return $this->belongsTo('App\Category','category_id');
    }
    public function RentedCar()
    {
        return $this->hasOne('App\rentedCar');
    }
    public function Delete(){
        $this->RentedCar()->delete();
        return parent::delete();
    }
}
