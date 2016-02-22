<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emergency';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'taxi_id',
        'seen'
    ];

    public function taxi(){
        return $this->belongsTo('App\Taxi');
    }
}
