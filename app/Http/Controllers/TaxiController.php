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
use Illuminate\Support\Facades\Hash;
use Image;

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

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * If the radio button create_driver is set to create driver it will create a new taxi with a driver and instantly links them together.
     * If the create_driver radio button is set to assign it will pick a driver from the select and after creating the taxi it links them together.
     */
    public function addTaxi(Request $request){

        if($request['create_driver'] == 'create'){
            $request['driver'] = 0;
        }
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
        if($request['create_driver'] == 'create'){
            $userData = array(
                'email'                 => $request['email'],
                'phone_number'          => $request['phonenumber'],
                'firstname'             => $request['firstname'],
                'lastname'              => $request['lastname'],
                'password'              => $request['password'],
                'password_confirmation' => $request['password_confirmation'],
                'sex'                   => $request['sex'],
                'drivers_exp'           => $request['driver_exp'],
                'global_information'    => $request['global_information'],
                'user_rank' => 'driver'
            );

            $userRules = array(
                'email'                 =>'required|email|unique:user',
                'phone_number'          =>'required|numeric|digits:10',
                'firstname'             =>'required',
                'lastname'              =>'required',
                'password'              => 'required|min:4|confirmed',
                'password_confirmation' => 'required|min:4',
                'drivers_exp'           => 'numeric',
                'sex'                   => 'required|in:man,vrouw'
            );
            $validator = Validator::make($userData, $userRules);
            $merge = array_merge($data, $userData);

            if ($validator->fails()){
                return redirect('/taxitoevoegen')->withErrors($validator)->withInput($merge);
            }
            array_forget($userData, 'password_confirmation');
            $userData['password'] = Hash::make($request['password']);
            $user = User::create($userData);

            $this->upload($request,$user->id);

            $driverData = array(
                'user_id'               => $user->id,
                'taxi_id'               => $taxi->id,
                'drivers_exp'           => $request['driver_exp'],
                'global_information'    => $request['global_information']
            );
            $driver = Driver::create($driverData);

            $taxi->where('id',$taxi->id)->update(['driver_id' => $driver->id]);
        }else{
            Driver::where('id',$data['driver_id'])->update(['taxi_id' => $taxi->id]);
        }
		session()->flash('alert-success','De taxi is aangemaakt.');
		return redirect()->route('taxioverzicht');
	}

    /**
     * @author Stefano Groenland
     * @return \Illuminate\Http\RedirectResponse
     *
     * Grabs the ID of the taxi, And deletes the corresponding rows from the Database.
     */
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

    /**
     * @authors Stefano Groenland, Richard Perdaan
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the file named 'profile_photo' from the request and uploads it onto the server,
     * It updates the corresponding user with the link to the uploaded picture as their profile_photo in the User table.
     */
    public function upload(Request $request , $id){
        $x = $request['x'];
        $y = $request['y'];
        $h = $request['h'];
        $w = $request['w'];

        $file = array('profile_photo' => $request->file('profile_photo'));
        $rules = array('profile_photo' => 'required|mimes:jpeg,bmp,png,jpg',);
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            if ($file) {
                //$request->session()->flash('alert-danger', 'U heeft geen bestand / geen geldig bestand gekozen om te uploaden, voeg een foto toe.');
            }
            return redirect('/taxitoevoegen');
        } else {
            if ($request->file('profile_photo')->isValid()) {
                $destinationPath = 'assets/uploads';
                $extension = $request->file('profile_photo')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                $request->file('profile_photo')->move($destinationPath, $fileName);
                $ava = $destinationPath . '/' . $fileName;
                $img = Image::make($ava)->fit(200)->crop($w, $h, $x, $y)->save();
                $final = $destinationPath . '/' . $img->basename;
                User::uploadPicture($id, $final);

            } else {
                $request->session()->flash('alert-danger', 'Er is een fout opgetreden tijdens het uploaden van uw bestand.');
            }
        }
        return redirect('/taxioverzicht');
    }
}
