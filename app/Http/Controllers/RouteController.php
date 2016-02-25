<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;


use App\Route as Route2;
use App\Driver;
use App\Taxi;
class RouteController extends Controller
{
	public function showRoutes(){

        $routes = Route2::with('taxi')->get();
        foreach($routes as $route){
        }
        $drivers = Driver::with('user')->get();


		return View::make('/ritten', compact('taxis','drivers','routes'));
	}
	public function showRoutesAdd(){
		return View::make('/rittoevoegen');
	}
	public function showRoutesEdit(){
		return View::make('/ritwijzigen');
	}
}
