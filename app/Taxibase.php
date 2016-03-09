<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxibase extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'taxibase';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude',
        'longtitude',
        'base_name'
    ];

    public $timestamps = false;
}
