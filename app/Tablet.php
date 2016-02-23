<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tablet';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'taxi_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function taxi(){
        return $this->belongsTo('App\Taxi');
    }

}
