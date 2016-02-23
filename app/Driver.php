<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'driver';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'drivers_exp',
        'global_information',
        'star_rating'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function taxi(){
        return $this->belongsTo('App\Taxi');
    }
    public function comment(){
        return $this->hasMany('App\Comment');
    }

}
