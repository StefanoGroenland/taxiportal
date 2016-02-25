<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showIndex(){
        return View::make('/index');
    }
    public function showProfile(){
        return View::make('/profiel');
    }
    public function showProfileEdit(){
        return View::make('/profielwijzigen');
    }
    public function showDrivers(){
        $drivers = Driver::with('user','taxi')->get();
        return View::make('/chauffeurs', compact('drivers','taxis'));
    }
    public function showDriversEdit(){
        return View::make('/chauffeurwijzigen');
    }
    public function showDriversAdd(){
        return View::make('/chauffeurtoevoegen');
    }
    public function showTablet(){
        return View::make('/tablets');
    }
    public function showTabletEdit(){
        return View::make('/tabletwijzigen');
    }
    public function showAdmin(){
        return View::make('/medewerkers');
    }
    public function showAdminEdit(){
        return View::make('/medewerkerwijzigen');
    }
    public function showAdminAdd(){
        return View::make('/medewerkertoevoegen');
    }
    public function addDriver(Request $request){

        $userData = array(
            'email' => $request['email'],
            'phone_number' => $request['phonenumber'],
            'firstname' => $request['firstname'],
            'surname' => $request['surname'],
            'lastname' => $request['lastname'],
            'password' => $request['repeat_password'],
            'global_information' => $request['global_information'],
            'user_rank' => 'driver'
        );

        $userRules = array(
            'email' =>'required',
            'phone_number' =>'required',
            'firstname' =>'required',
            'lastname' =>'required',
            'password' =>'required',
            'global_information' =>'required',
            'user_rank' =>'required'
        );
        $validator = Validator::make($userData, $userRules);
        if ($validator->fails()){
            return redirect('chauffeurs')->withErrors($validator)->withInput($userData);
        }

        $user = User::create($userData);

        $driverData = array(
            'user_id' => $user->id,
            'drivers_exp' => $request['driver_exp']
        );

        Driver::create($driverData);
        return redirect()->route('chauffeurs');
    }
}

