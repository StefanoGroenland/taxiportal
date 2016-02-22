<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;

class AdController extends Controller
{
    public function showAds(){
        return View::make('/reclames');
    }
    public function showAdsEdit(){
        return View::make('/reclamewijzigen');
    }
    public function showAdsAdd(){
        return View::make('/reclametoevoegen');
    }
}

