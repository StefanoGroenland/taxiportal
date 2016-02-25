<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Taxi;
use App\Driver;

class TaxiController extends Controller
{
	public function showTaxiLocation(){
        $taxis = Taxi::all();
        $drivers = Driver::with('user')->get();
		return View::make('/taxilocatie', compact('taxis', 'drivers'));
	}
	public function showTaxiOverview(){
        $taxis = Taxi::all();
        $drivers = Driver::with('user')->get();
		return View::make('/taxioverzicht', compact('taxis', 'drivers'));
	}
	public function showTaxiEdit(){
		return View::make('/taxiwijzigen');
	}
	public function showTaxiAdd(){
		return View::make('/taxitoevoegen');
	}
}
