<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;

class TaxiController extends Controller
{
	public function showTaxiLocation(){
		return View::make('/taxilocatie');
	}
	public function showTaxiOverview(){
		return View::make('/taxioverzicht');
	}
	public function showTaxiEdit(){
		return View::make('/taxiwijzigen');
	}
	public function showTaxiAdd(){
		return View::make('/taxitoevoegen');
	}
}
