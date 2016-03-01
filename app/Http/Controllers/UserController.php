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
use Illuminate\Support\Facades\Hash as Hash;
use Image as Image;
use File;
use App\Http\Controllers\Storage;

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
        $drivers = Driver::with('user','taxi','comment')->get();
        return View::make('/chauffeurs', compact('drivers','taxis','comment'));
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
            'lastname' => $request['lastname'],
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'sex' => $request['sex'],
            'drivers_exp' => $request['driver_exp'],
            'global_information' => $request['global_information'],
            'user_rank' => 'driver'
        );

        $userRules = array(
            'email' =>'required|email|unique:user',
            'phone_number' =>'required|numeric|digits:10',
            'firstname' =>'required',
            'lastname' =>'required',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
            'drivers_exp' => 'numeric',
            'sex' => 'required|in:man,vrouw'
        );

        $validator = Validator::make($userData, $userRules);
        if ($validator->fails()){
            return redirect('chauffeurtoevoegen')->withErrors($validator)->withInput($userData);
        }
        array_forget($userData, 'password_confirmation');
        $userData['password'] = Hash::make($request['password']);
        $user = User::create($userData);

        $this->upload($request,$user->id);

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
        $request->session()->flash('alert-success', 'De chauffeur is toegevoegd.');
        return redirect()->route('chauffeurs');
    }

    public function deleteDriver(){
       
        $id  = Route::current()->getParameter('id');
        $find = User::find($id);
        $driver = Driver::where('user_id','=',$find->id)->first();
        Taxi::where('driver_id','=',$driver->id)->update(array('driver_id' => 0));
        User::where('id','=', $id)->delete();
        Driver::where('user_id','=',$id)->delete();
        if(!$find->profile_photo == ""){
            unlink($find->profile_photo);
        }
        
        session()->flash('alert-success', 'chauffeur '. $find->firstname.' verwijderd.');
        return redirect()->route('chauffeurs');
    }
    public function editDriver(Request $request){
       
        $id = Route::current()->getParameter('id');
        $driver = Driver::where('user_id','=',$id)->first();

        $userData = array(
            'email' => $request['email'],
            'phone_number' => $request['phonenumber'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'password' => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'sex' => $request['sex'],
        ); 
        $userRules = array(
            'email' =>'required|email',
            'phone_number' =>'required|numeric|digits:10',
            'firstname' =>'required',
            'lastname' =>'required',
            'password' => 'min:4',
            'password_confirmation' => 'min:4',
            'sex' =>'required|in:man,Man,vrouw,Vrouw'
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
       
        if (empty($userData['password']) || empty($userData['password_confirmation'])) {
            array_forget($userData, 'password');
            array_forget($userData, 'password_confirmation');
        }

        if (array_key_exists('password', $userData)) {
            $userData['password'] = Hash::make($userData['password']);
            array_forget($userData, 'password_confirmation');
        } else {
            $user = User::where('id', '=', $id)->update($userData);
            $this->upload($request, $id);
            $request->session()->flash('alert-success', 'Uw account is gewijziged, er zijn geen wijzigingen aan het wachtwoord doorgevoerd.');
            return redirect('/chauffeurs');
        }
       
        $user = User::where('id', '=', $id)->update($userData);
        $request->session()->flash('alert-success', 'Uw account is gewijziged.');
        $this->upload($request, $id);
        return redirect('/chauffeurs');
        
    }
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
            return redirect('/chauffeurtoevoegen');
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
                $request->session()->flash('alert-success', 'Chauffeur toegevoegd');
                return redirect('/chauffeurs');
            } else {
                $request->session()->flash('alert-danger', 'Er is een fout opgetreden tijdens het uploaden van uw bestand.');
                return redirect('/profiel');
            }
        }

    }
}

