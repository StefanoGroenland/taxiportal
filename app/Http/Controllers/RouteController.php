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
		$cars = Taxi::where('driver_id','>','0')->where('in_shift','=','1')->get();
        $carCount = count($cars);
		return View::make('/rittoevoegen', compact('cars','carCount'));
	}
	public function showRoutesEdit(){
		$id = Route::current()->getParameter('id');
		$routes = Route2::with('taxi')->where('id',$id)->first();
		
		$cars = Taxi::where('driver_id','>','0')->where('in_shift','=','1')->get();
        $carCount = count($cars);

		return View::make('/ritwijzigen', compact('id','routes','cars','carCount'));
	}
	public function addRoute(Request $request){

		$data = array(
			'start_city'        => $request['start_city'],
			'start_zip'         => $request['start_zip'],
			'start_number'      => $request['start_number'],
			'start_street'      => $request['start_street'],
			'end_city'          => $request['end_city'],
			'end_zip'           => $request['end_zip'],
			'end_number'        => $request['end_number'],
			'end_street'        => $request['end_street'],
			'pickup_time'       => $request['pickup_time'],
			'phone_customer'    => $request['phone_customer'],
			'email_customer'    => $request['email_customer'],
			'taxi_id'			=> $request['taxi']
		);
		
		//todo date format check
		$rules = array(
			'start_city'        => 'required',
			'start_zip'         => 'required',
			'start_number'      => 'required|numeric',
			'start_street'      => 'required',
			'end_city'          => 'required',
			'end_zip'           => 'required',
			'end_number'        => 'required|numeric',
			'end_street'        => 'required',
			'pickup_time'       => 'required',
			'phone_customer'    => 'required|numeric|digits:10',
			'email_customer'    => 'required|email'
		);

		$data['pickup_time'] = date('Y-m-d H:i', strtotime($data['pickup_time']));

		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			return redirect('rittoevoegen')->withErrors($validator)->withInput($data);
		}
		Route2::create($data);
		session()->flash('alert-success','De route is aangemaakt.');
		return redirect()->route('ritten');
	}
	public function deleteRoute(){
		$id = Route::current()->getparameter('id');
		$find = Route2::find($id);
		Route2::where('id','=', $id)->delete();
		session()->flash('alert-success','De route is verwijderd.');
		return redirect()->route('ritten');
	}
	public function editRoute(Request $request){
        $id = Route::current()->getParameter('id');
        
        $data = array(
            'start_city'        => $request['start_city'],
			'start_zip'         => $request['start_zip'],
			'start_number'      => $request['start_number'],
			'start_street'      => $request['start_street'],
			'end_city'          => $request['end_city'],
			'end_zip'           => $request['end_zip'],
			'end_number'        => $request['end_number'],
			'end_street'        => $request['end_street'],
			'pickup_time'       => $request['pickup_time'],
			'phone_customer'    => $request['phone_customer'],
			'email_customer'    => $request['email_customer'],
			'taxi_id'			=> $request['taxi']
        );
       
         $rules = array(
           	'start_city'        => 'required',
			'start_zip'         => 'required',
			'start_number'      => 'required|numeric',
			'start_street'      => 'required',
			'end_city'          => 'required',
			'end_zip'           => 'required',
			'end_number'        => 'required|numeric',
			'end_street'        => 'required',
			'pickup_time'       => 'required',
			'phone_customer'    => 'required|numeric|digits:10',
			'email_customer'    => 'required|email'
        );
       
        $data['pickup_time'] = date('Y-m-d H:i', strtotime($data['pickup_time']));
        
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('ritwijzigen/'.$id)->withErrors($validator)->withInput($data);
        }

        Route2::where('id', '=', $id)->update($data);

        $request->session()->flash('alert-success', 'De route is gewijzigd.');
        return redirect()->route('ritten'); 
    }
}
