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
}
