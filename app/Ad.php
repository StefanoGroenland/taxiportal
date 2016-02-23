<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ad';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link',
        'locations',
        'clicks',
        'banner'
    ];

    public function adLocation(){
        return $this->hasMany('App\AdLocation');
    }
}
