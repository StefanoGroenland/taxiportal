<?php

namespace App\Http\Controllers;
use App\Emergency;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Taxi;
use App\Driver;
use App\User;
use App\Taxibase;
use Illuminate\Support\Facades\Validator;

class TaxiController extends Controller
{
    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the taxi location view and passes a variable with it.
     */
    public function showTaxiLocation(){
        $cars = Taxi::with('driver','emergency')->where('in_shift',1)->where('last_latitude','!=','')->where('last_longtitude','!=','')->get();
        $taxis = Taxi::with('driver','emergency')->where('in_shift',1)->get();
        $bases = Taxibase::all();
		return View::make('/taxilocatie', compact('bases','taxis','cars'));
	}

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the taxi overview view and passes 2 variables with it.
     */
    public function showTaxiOverview(){
        $taxis = Taxi::all();
        $drivers = Driver::with('user')->get();
		return View::make('/taxioverzicht', compact('taxis', 'drivers'));
	}

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     *  TODO : fill in func description
     */
    public function showTaxiEdit(){
    	$id = Route::current()->getParameter('id');
        $taxi = Taxi::where('id',$id)->first();
        $user = Taxi::with('driver')->where('id',$id)->first();
        $drivers = Driver::with('user')->where('taxi_id','0')->orWhere('taxi_id',$id)->get();
        $driverCount   = count($drivers);
       return View::make('/taxiwijzigen', compact('id','taxi','user','drivers','driverCount'));
     }

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     *  TODO : fill in func description
     */
    public function showTaxiAdd(){
    	$drivers = Driver::with('user')->where('taxi_id','0')->get();
    	$driverCount = count($drivers);
		return View::make('/taxitoevoegen', compact('drivers','driverCount'));
	}
	public function addTaxi(Request $request){

		$data = array(
			'license_plate' 	=> strtoupper($request['license_plate']),
			'car_brand' 		=> $request['car_brand'],
			'car_color' 		=> $request['car_color'],
			'car_model' 		=> $request['car_model'],
			'driver_id'			=> $request['driver']
		);
		$rules = array(
			'license_plate' 	=> 'required',
			'car_model'			=> 'required',
			'car_color'			=> 'required',
			'car_model'			=> 'required'
		);

		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			return redirect('taxitoevoegen')->withErrors($validator)->withInput($data);
		}
		$taxi = Taxi::create($data);
        Emergency::create(array(
            'taxi_id'   =>  $taxi->id,
            'seen'      =>  '1'
        ));
		Driver::where('id',$data['driver_id'])->update(['taxi_id' => $taxi->id]);
		session()->flash('alert-success','De taxi is aangemaakt.');
		return redirect()->route('taxioverzicht');
	}
	public function deletetaxi(){
		$id = Route::current()->getparameter('id');
		$find = Taxi::find($id);
        Emergency::where('taxi_id',$find->id)->delete();
		$find->delete();
		session()->flash('alert-success','De Taxi is verwijderd.');
		return redirect()->route('taxioverzicht');
	}
	public function editTaxi(Request $request){
		$id = Route::current()->getParameter('id');
        $data = array(
			'license_plate' 	=> strtoupper($request['license_plate']),
			'car_brand' 		=> $request['car_brand'],
			'car_color' 		=> $request['car_color'],
			'car_model' 		=> $request['car_model'],
			'driver_id'			=> $request['driver']
		);
		$rules = array(
			'license_plate' 	=> 'required',
			'car_model'			=> 'required',
			'car_color'			=> 'required',
			'car_model'			=> 'required'
		);

		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			return redirect('taxiwijzigen')->withErrors($validator)->withInput($data);
		}
		
		Taxi::where('id', '=', $id)->update($data);
		session()->flash('alert-success','De taxi is gewijzigd.');
		return redirect()->route('taxioverzicht');
    }
}
