<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps=false;
    protected $table="types";
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
