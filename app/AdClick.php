<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdClick extends Model
{
 	protected $table = 'ad_click'; 


 	protected $fillable = [
 		'ad_id',
        'clicks'
 	];

 	public function ad(){
 		return $this->belongsTo('App\Ad');
 	}
}
