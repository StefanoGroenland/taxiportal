<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Newspaper;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use Illuminate\Support\Facades\Validator;
use App\Taxi;
use App\Comment;
use App\Tablet;
class UserController extends Controller
{
    public function showIndex(){
        return View::make('/index');
    }
    public function showProfile(){
        $comments = Comment::with('driver')->where('approved','=','1')->get();
        return View::make('/profiel', compact('comments'));
    }
    public function showProfileEdit(){
        return View::make('/profielwijzigen');
    }
    public function showDrivers(){
        $drivers = Driver::with('user','taxi')->get();
        return View::make('/chauffeurs', compact('drivers','taxis'));
    }
    public function showDriversEdit(){
        $id = Route::current()->getParameter('id');
        $driver = Driver::with('user')->where('user_id','=',$id)->first();

        $cars = Taxi::where('driver_id','=','0')->get();
        $carCount = count($cars);

        return View::make('/chauffeurwijzigen', compact('id','driver','cars','carCount'));  
    }
    public function showDriversAdd(){
        $cars = Taxi::where('driver_id','=','0')->get();
        $carCount = count($cars);
        return View::make('/chauffeurtoevoegen', compact('cars','carCount'));
    }
    public function showTablet(){
        $tablets = Tablet::with('taxi','user')->get();
        return View::make('/tablets', compact('tablets'));
    }
    public function showTabletEdit(){
        return View::make('/tabletwijzigen');
    }
    public function showAdmin(){
        $admins = User::where('user_rank','=','admin')->get();
        return View::make('/medewerkers',compact('admins'));
    }
    public function showAdminEdit(){
        return View::make('/medewerkerwijzigen');
    }
    public function showAdminAdd(){
        return View::make('/medewerkertoevoegen');
    }
    public function showNews(){
        $news = Newspaper::all();
        return View::make('/nieuws', compact('news'));
    }
    public function addDriver(Request $request){

        $userData = array(
            'email' => $request['email'],
            'phone_number' => $request['phonenumber'],
            'firstname' => $request['firstname'],
            'surname' => $request['surname'],
            'lastname' => $request['lastname'],
            'sex' => $request['sex'],
            'user_rank' => 'driver'
        );

        $userRules = array(
            'email' =>'required',
            'phone_number' =>'required',
            'firstname' =>'required',
            'lastname' =>'required',
            'sex' =>'required'
        );
        $validator = Validator::make($userData, $userRules);
        if ($validator->fails()){
            return redirect('chauffeurstoevoegen')->withErrors($validator)->withInput($userData);
        }

        $user = User::create($userData);
        $driverData = array(
            'user_id' => $user->id,
            'drivers_exp' => $request['driver_exp'],
            'global_information' => $request['global_information']
        );
        
        $driver = Driver::create($driverData);
        $taxiData = array(
            'driver_id' => $driver->id
        );

        Taxi::where('id','=', $request['car'])->update($taxiData);
        return redirect()->route('chauffeurs');
    }

    public function deleteDriver(Request $request){
       $id  = Route::current()->getParameter('id');
       $find = User::find($id);
       $driver = Driver::where('user_id','=',$find->id)->first();
       Taxi::where('driver_id','=',$driver->id)->update(array('driver_id' => 0));
       User::where('id','=', $id)->delete();
       Driver::where('user_id','=',$id)->delete();
       session()->flash('alert-success', 'chauffeur'. $find->firstname.' verwijderd.');
       return redirect()->route('chauffeurs');
    }
    public function editDriver(Request $request){
       
       
       $id = Route::current()->getParameter('id');
       $driver = Driver::where('user_id','=',$id)->first();
         $userData = array(
            'email' => $request['email'],
            'phone_number' => $request['phonenumber'],
            'firstname' => $request['firstname'],
            'surname' => $request['surname'],
            'lastname' => $request['lastname'],
            'sex' => $request['sex'],
        ); 

        $userRules = array(
            'email' =>'required',
            'phone_number' =>'required',
            'firstname' =>'required',
            'lastname' =>'required',
            'sex' =>'required',
        );

        $driverData = array(
            'user_id' => $id,
            'drivers_exp' => $request['driver_exp'],
            'global_information' => $request['global_information']
        );

        Driver::where('user_id', '=', $id)->update($driverData);

        Taxi::where('driver_id','=', $driver->id)->update(array('driver_id' => '0'));
        Taxi::where('id','=',$request['car'])->update(array('driver_id' => $driver->id));

        $validator = Validator::make($userData, $userRules);
        if ($validator->fails()){
            return redirect('chauffeurwijzigen/'.$id)->withErrors($validator)->withInput($userData);
        }

        User::where('id', '=', $id)->update($userData);
        
        $request->session()->flash('alert-success', 'chauffeur ' . $request['firstname'] . ' is veranderd.');
        return redirect()->route('chauffeurs'); 
    }
}

