<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'route';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'taxi_id',
        'start_city',
        'start_zip',
        'start_number',
        'start_street',
        'end_city',
        'end_zip',
        'end_number',
        'end_street',
        'pickup_time',
        'phone_customer',
        'email_customer',
        'processed'
    ];

    public function taxi(){
        return $this->belongsTo('App\Taxi');
    }
}
