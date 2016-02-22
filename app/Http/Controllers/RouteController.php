<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;

class RouteController extends Controller
{
	public function showRoutes(){
		return View::make('/ritten');
	}
	public function showRoutesAdd(){
		return View::make('/rittoevoegen');
	}
	public function showRoutesEdit(){
		return View::make('/ritwijzigen');
	}
}
