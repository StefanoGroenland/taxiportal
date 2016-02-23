<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'taxi';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'driver_id',
        'last_seen',
        'last_latitude',
        'last_longtitude',
        'license_plate',
        'car_brand',
        'car_color',
        'car_model',
        'in_shift'
    ];

    public function tablet(){
        return $this->hasMany('App\Tablet');
    }
    public function driver(){
        return $this->hasOne('App\Driver');
    }
    public function emergency(){
        return $this->hasMany('App\Emergency');
    }
    public function route(){
        return $this->hasMany('App\Route');
    }



}
