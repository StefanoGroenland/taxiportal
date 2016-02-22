<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdLocation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ad_location';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ad_id',
        'locations'
    ];

    public function ad(){
        return $this->belongsTo('App\Ad');
    }
}