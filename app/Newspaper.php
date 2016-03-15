<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Newspaper extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'newspaper';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'link',
        'logo'
    ];

    public static function uploadPicture($id, $img)
    {
        DB::table('newspaper')
            ->where('id', $id)
            ->update(['logo' => $img]);
    }
}
