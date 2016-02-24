<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        'location'
    ];

    public $timestamps = false;

    public function ad(){
        return $this->belongsTo('App\Ad');
    }
    public static function insertLocals($id,$location){
        return DB::table('ad_location')->insert([
            'ad_id'     =>  $id,
            'location'  =>  $location
        ]);
    }
    public static function updateLocals($id,$location){
        if(!empty($location)){
            DB::table('ad_location')
                ->insert([
                    'ad_id'     =>  $id,
                    'location'  =>  trim($location)
                ]);
        }


    }

    public static function deleteLocals($id){
        DB::table('ad_location')->where('ad_id',$id)->delete();
    }
}