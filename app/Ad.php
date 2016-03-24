<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function adClicks(){
        return $this->hasMany('App\AdClick');
    }
    public static function uploadPicture($id, $img)
    {
        DB::table('ad')
            ->where('id', $id)
            ->update(['banner' => $img]);
    }
}
