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
}
