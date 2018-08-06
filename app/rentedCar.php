<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class rentedCar extends Model
{
    protected $table='rentedcars';
    protected $fillable=['car_id','user_id','start_date','end_date'];
    public function  user()
    {
        return $this->$this->belongsTo('App\User');
    }
    public function  car()
    {
        return $this->belongsTo('App\Car','car_id');
    }
}
