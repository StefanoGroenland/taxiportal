<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Ad;

class AdController extends Controller
{
    public function showAds(){
        $ads = Ad::with('adLocation')->get();
        return View::make('/reclames', compact('ads'));
    }
    public function showAdsEdit(){
        return View::make('/reclamewijzigen');
    }
    public function showAdsAdd(){
        return View::make('/reclametoevoegen');
    }
}