<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Route as Route2;
use App\Driver;
use App\Taxi;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
	public function showRoutes(){

        $routes = Route2::with('taxi')->get();

		return View::make('/ritten', compact('routes'));
	}
	public function showRoutesAdd(){
		return View::make('/rittoevoegen');
	}
	public function showRoutesEdit(){
		return View::make('/ritwijzigen');
	}
	public function addRoute(Request $request){

		$data = array(
			'start_city' => $request['start_city'],
			'start_zip' => $request['start_zip'],
			'start_number' => $request['start_number'],
			'start_street' => $request['start_street'],
			'end_city' => $request['end_city'],
			'end_zip' => $request['end_zip'],
			'end_number' => $request['end_number'],
			'end_street' => $request['end_street'],
			'pickup_time'=> $request['pickup_time'],
			
		);
		
		$rules = array(
			'start_city' => 'required',
			'start_zip' => 'required',
			'start_number' => 'required',
			'start_street' => 'required',
			'end_city' => 'required',
			'end_zip' => 'required',
			'end_number' => 'required',
			'end_street' => 'required',
			'pickup_time'=> 'required',
		);

		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			return redirect('rittoevoegen')->withErrors($validator)->witInput($data);
		}
		$routs = Route2::create($data);
		return redirect('ritten');
	}
}
