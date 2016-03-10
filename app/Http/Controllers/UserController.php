<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Newspaper;
use App\Taxibase;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the index view.
     */
    public function showIndex(){
        $cars = Taxi::with('emergency','driver')->where('in_shift',1)->where('last_latitude','!=','')->where('last_longtitude','!=','')->get();
        $bases = Taxibase::all();
        $today = date('Y-m-d');
        $routeCount = 0;
        $countCars = count(Taxi::where('in_shift',1)->get());
        $countRoutes = \App\Route::where('processed',1)->get();

        foreach($countRoutes as $route){
            if(date('Y-m-d',strtotime($route->pickup_time)) == $today){
                if(Auth::user()->user_rank != 'admin'){
                    if($route->taxi && $route->taxi->driver){
                        if($route->taxi->driver->user_id == Auth::user()->id){
                            $routeCount++;
                        }
                    }
                }else{
                    $routeCount++;
                }
            }
        }
        $countOpenRoutes = count(\App\Route::where('processed',0)->get());
        $driver = Driver::with('user')->where('user_id',Auth::user()->id)->first();
        if(Auth::user()->user_rank != 'admin'){
            $countComments = count(Comment::where('approved',1)->where('seen',0)->where('driver_id',$driver->id)->get());
        }else{
            $countComments = count(Comment::where('approved',0)->get());
        }

        return View::make('/index',compact('bases','today','routeCount','countCars','countOpenRoutes','countComments','cars'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the profile view and passes a variable of comments with it.
     */
    public function showProfile(){
        $driver = Driver::with('user')->where('user_id',Auth::user()->id)->first();
        $comments = Comment::with('driver')->where('approved','=','1')->get();

        foreach($comments as $comment){
            if($driver){
                $comment->where('driver_id',$driver->id)->update(['seen' => 1]);
            }
        }
        if(Auth::user()->user_rank == 'admin'){
            return $this->showProfileEdit();
        }else{
            return View::make('/profiel', compact('comments'));
        }
    }

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     *  TODO : fill in func description..
     */
    public function showProfileEdit(){
        $id = Auth::user()->id;
        return View::make('/profielwijzigen', compact('id'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the drivers overview view and passes a series of variables with it.
     */
    public function showDrivers(){
        $drivers = Driver::with('user','taxi','comment')->get();
        return View::make('/chauffeurs', compact('drivers','taxis','comment'));
    }

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     * Gets the id of the corresponding driver to define which driver will be shown in the view,
     * and defines a series of 2 other variables to show the car count available and all cars.
     */
    public function showDriversEdit(){
        $id         = Route::current()->getParameter('id');
        $driver     = Driver::with('user')->where('user_id','=',$id)->first();

        $cars       = Taxi::where('driver_id','=','0')->orWhere('driver_id',$driver->id)->get();
        $carCount   = count($cars);

        return View::make('/chauffeurwijzigen', compact('id','driver','cars','carCount'));  
    }

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     * Gets all cars and passes them along with the view so a new driver can be assigned to a available car.
     */
    public function showDriversAdd(){
        $cars       = Taxi::where('driver_id','=','0')->get();
        $carCount   = count($cars);
        return View::make('/chauffeurtoevoegen', compact('cars','carCount'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Gets all the tablets which are linked to a taxi and passes them along when making the view.
     */
    public function showTablet(){
        $tablets = Tablet::with('taxi','user')->get();
        return View::make('/tablets', compact('tablets'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     *  TODO : fill in func description
     */
    public function showTabletAdd(){
        $cars   = Taxi::all();
        return View::make('/tablettoevoegen', compact('cars'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     *  TODO : fill in func description
     */
    public function showTabletEdit(){
        $id     = Route::current()->getParameter('id');
        $tablet = Tablet::where('id',$id)->first();
        $user   = User::where('id',$tablet->user_id)->first();
        $cars   = Taxi::all();
        return View::make('/tabletwijzigen',compact('id','tablet','user','cars'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Grabs all users with the user rank 'admin' out the database and passes them when making the view.
     */
    public function showAdmin(){
        $admins = User::where('user_rank','=','admin')->get();
        return View::make('/medewerkers',compact('admins'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     *  Grabs the ID of the current route, looks for a user with that ID, and returns both the id and the User found along while making the View.
     */
    public function showAdminEdit(){
        $id = Route::current()->getParameter('id');
        $admin = User::where('id',$id)->first();

        return View::make('/medewerkerwijzigen',compact('admin','id'));
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Uses the route parameter to define which user has to be edited,
     * Gets all inputs filled in and checks them for validation. If all passed correctly the User gets updated.
     */
    public function editAdmin(Request $request){
        $id = Route::current()->getParameter('id');
        $user = User::where('id','=',$id)->first();

        $userData = array(
            'email'                 => $request['email'],
            'phone_number'          => $request['phonenumber'],
            'firstname'             => $request['firstname'],
            'lastname'              => $request['lastname'],
            'password'              => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'sex'                   => $request['sex'],
        );
        $userRules = array(
            'email'                 => 'required|email',
            'phone_number'          => 'required|numeric|digits:10',
            'firstname'             => 'required',
            'lastname'              => 'required',
            'password'              => 'min:4',
            'password_confirmation' => 'min:4',
            'sex'                   => 'required|in:man,vrouw'
        );
        $validator = Validator::make($userData, $userRules);
        if ($validator->fails()){
            return redirect('medewerkerwijzigen/'.$id)->withErrors($validator)->withInput($userData);
        }

        if (empty($userData['password']) || empty($userData['password_confirmation'])) {
            array_forget($userData, 'password');
            array_forget($userData, 'password_confirmation');
        }

        if (array_key_exists('password', $userData)) {
            $userData['password'] = Hash::make($userData['password']);
            array_forget($userData, 'password_confirmation');
        } else {
            User::where('id', '=', $id)->update($userData);
            $this->upload($request, $id);
            $request->session()->flash('alert-success', 'Medewerker account is gewijziged, er zijn geen wijzigingen aan het wachtwoord doorgevoerd.');
            return redirect('/medewerkers');
        }

        $user->update($userData);
        $request->session()->flash('alert-success', 'Het account met e-mail '. $user->email .' is gewijziged.');
        $this->upload($request, $id, 1);
        return redirect('/medewerkers');

    }

    /**
     * @author Stefano Groenland
     * @return \Illuminate\Http\RedirectResponse
     *
     * Uses the route parameter to define which corresponding user is selected,
     * then deletes the user from the database. It even deletes their profile picture from the server!
     */
    public function deleteAdmin(){
        $id  = Route::current()->getParameter('id');
        $find = User::find($id);

        User::where('id','=',$id)->delete();
        if(!$find->profile_photo == ""){
            unlink($find->profile_photo);
        }
        session()->flash('alert-success', 'Medewerker '. $find->firstname.' verwijderd.');
        return redirect()->route('medewerkers');
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the view for showing the form for adding a new admin user.
     */
    public function showAdminAdd(){
        return View::make('/medewerkertoevoegen');
    }

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Uses the request parameter to define all inputs ,
     * checks all inputs passed if they are filled in correctly and then makes the User.
     *
     */
    public function addAdmin(Request $request){
        $userData = array(
            'email'                 => $request['email'],
            'phone_number'          => $request['phonenumber'],
            'firstname'             => $request['firstname'],
            'lastname'              => $request['lastname'],
            'password'              => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'sex'                   => $request['sex'],
            'user_rank' => 'admin'
        );

        $userRules = array(
            'email'                 => 'required|email|unique:user',
            'phone_number'          => 'required|numeric|digits:10',
            'firstname'             => 'required',
            'lastname'              => 'required',
            'password'              => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
            'sex'                   => 'required|in:man,vrouw'
        );
        $validator = Validator::make($userData, $userRules);
        if ($validator->fails()){
            return redirect('medewerkertoevoegen')->withErrors($validator)->withInput($userData);
        }
        array_forget($userData, 'password_confirmation');
        $userData['password'] = Hash::make($request['password']);
        $user = User::create($userData);

        $this->upload($request,$user->id,1);

        $request->session()->flash('alert-success', 'De medewerker is toegevoegd.');
        return redirect()->route('medewerkers');
    }

    /**
     * @author Richard Perdaan
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Uses the request parameter to define all inputs ,
     * checks all inputs passed if they are filled in correctly and then makes the Driver with linked user details.
     *
     */
    public function addDriver(Request $request){
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
        if ($validator->fails()){
            return redirect('chauffeurtoevoegen')->withErrors($validator)->withInput($userData);
        }
        array_forget($userData, 'password_confirmation');
        $userData['password'] = Hash::make($request['password']);
        $user = User::create($userData);

        $this->upload($request,$user->id);

        $driverData = array(
            'user_id'               => $user->id,
            'drivers_exp'           => $request['driver_exp'],
            'global_information'    => $request['global_information']
        );

        $driver = Driver::create($driverData);
        $taxiData = array(
            'driver_id' => $driver->id
        );

        Taxi::where('id','=', $request['car'])->update($taxiData);
        $request->session()->flash('alert-success', 'De chauffeur is toegevoegd.');
        return redirect()->route('chauffeurs');
    }

    /**
     * @author Richard Perdaan
     * @return \Illuminate\Http\RedirectResponse
     *
     * Uses the route parameter to define which corresponding driver is selected,
     * then deletes the driver and linked user account from the database.
     */
    public function deleteDriver(){
        $id  = Route::current()->getParameter('id');
        $find = User::find($id);
        $driver = Driver::where('user_id','=',$find->id)->first();
        Taxi::where('driver_id','=',$driver->id)->update(array('driver_id' => 0));
        $find->delete();
        $driver->delete();
        if(!$find->profile_photo == ""){
            unlink($find->profile_photo);
        }
        session()->flash('alert-success', 'chauffeur '. $find->firstname.' verwijderd.');
        return redirect()->route('chauffeurs');
    }

    /**
     * @author Richard Perdaan
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Uses the route parameter to define which driver has to be edited,
     * Gets all inputs filled in and checks them for validation. If all passed correctly the Driver gets updated.
     */
    public function editDriver(Request $request){
       
        $id = Route::current()->getParameter('id');
        $driver = Driver::where('user_id','=',$id)->first();

        $userData = array(
            'email'                 => $request['email'],
            'phone_number'          => $request['phonenumber'],
            'firstname'             => $request['firstname'],
            'lastname'              => $request['lastname'],
            'password'              => $request['password'],
            'password_confirmation' => $request['password_confirmation'],
            'sex'                   => $request['sex'],
        ); 
        $userRules = array(
            'email'                 => 'required|email',
            'phone_number'          => 'required|numeric|digits:10',
            'firstname'             => 'required',
            'lastname'              => 'required',
            'password'              => 'min:4',
            'password_confirmation' => 'min:4',
            'sex'                   => 'required|in:man,vrouw'
        );

        $driverData = array(
            'user_id'               => $id,
            'drivers_exp'           => $request['driver_exp'],
            'global_information'    => $request['global_information'],
            'taxi_id'               => $request['car']
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
            User::where('id', '=', $id)->update($userData);
            $this->upload($request, $id);
            $request->session()->flash('alert-success', 'Uw account is gewijziged, er zijn geen wijzigingen aan het wachtwoord doorgevoerd.');
            return redirect('/chauffeurs');
        }
       
        User::where('id', '=', $id)->update($userData);
        $request->session()->flash('alert-success', 'Uw account is gewijziged.');
        $this->upload($request, $id);
        return redirect('/chauffeurs');
        
    }

    /**
     * @authors Stefano Groenland, Richard Perdaan
     * @param Request $request
     * @param $id
     * @param $redirect
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the file named 'profile_photo' from the request and uploads it onto the server,
     * It updates the corresponding user with the link to the uploaded picture as their profile_photo in the User table.
     */
    public function upload(Request $request , $id, $redirect = 0){
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
                if($redirect != 0){
                    $request->session()->flash('alert-success', 'Medewerker toegevoegd');
                    return redirect('/admins');
                }else{
                    $request->session()->flash('alert-success', 'Chauffeur toegevoegd');
                    return redirect('/chauffeurs');
                }


            } else {
                $request->session()->flash('alert-danger', 'Er is een fout opgetreden tijdens het uploaden van uw bestand.');

                if($redirect != 1){
                    return redirect('/admins');
                }elseif($redirect == 2){
                    return redirect('/profielwijzigen#tab_1_2');
                }
                else{
                    return redirect('/chauffeurs');
                }
            }
        }

    }


    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Gets values from the $request, validates the input on specific rules.
     * If all passes it will Create an Tablet account with a link of the tablet and taxi.
     */
    public function addTablet(Request $request){

        $userData = array(
            'user_rank'     =>  'tablet',
            'tablet_name'   =>  $request['tablet'],
            'email'         =>  str_random(15)
        );
        $userRules = array(
            'tablet_name'   =>  'required|max:50|unique:user'
        );
        $valid = Validator::make($userData,$userRules);
        if($valid->fails()){
            return redirect('tablettoevoegen')->withErrors($valid)->withInput($userData);
        }
        $user = User::create($userData);

        $tabData = array(
            'taxi_id'   =>  $request['taxi'],
            'user_id'   =>  $user->id
        );
        Tablet::create($tabData);

        $request->session()->flash('alert-success', 'De tablet is toegevoegd.');
        return redirect()->route('tablets');
    }

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Gets the ID of the route parameter, and grabs all information for a tablet with that id,
     * aswell as getting data from the $request and changes the linked rows with the values of the requests after validation.
     */
    public function editTablet(Request $request){
        $id = Route::current()->getParameter('id');
        $tablet = Tablet::where('id',$id)->first();
        $user = User::where('id',$tablet->user_id)->first();

        $tabUserData = array(
            'tablet_name'   => trim($request['tablet']),
            'taxi_id'   => $tablet->taxi_id
        );
        $tabUserRules = array(
            'tablet_name'   => 'required|max:50|unique:user,tablet_name,' . $user->id
        );
        $valid = Validator::make($tabUserData, $tabUserRules);
        if($valid->fails()){
            return redirect('tabletwijzigen/'.$id)->withErrors($valid)->withInput($tabUserData);
        }
        array_forget($tabUserData, 'taxi_id');
        $user->update($tabUserData);
        $tablet->update(['taxi_id' => $request['taxi']]);

        $request->session()->flash('alert-success', 'Tablet '. $request['tablet'] .' is gewijziged.');
        return redirect('/tablets');
    }

    /**
     * @author Stefano Groenland
     * @return \Illuminate\Http\RedirectResponse
     *
     * Grabs the ID of the route, And deletes the corresponding rows from the Database.
     */
    public function deleteTablet(){
        $id = Route::current()->getParameter('id');

        $tablet = Tablet::where('id',$id)->first();
        $user = User::where('id',$tablet->user_id)->first();
        Tablet::where('id',$id)->delete();
        User::where('id',$tablet->id)->delete();

        session()->flash('alert-success', 'Tablet '.$user->tablet_name .' verwijderd.');
        return redirect()->route('tablets');
    }

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the ID from the route, looks for an user with the given ID and edits it with the requests values if they passes the validation.
     */
    public function editProfile(Request $request){
        $id = Route::current()->getParameter('id');

        $user = User::where('id',$id)->first();

        $data = array(
            'firstname' =>  $request['firstname'],
            'lastname' =>  $request['lastname'],
            'phone_number' =>  $request['phone_number'],
            'email' =>  $request['email']
        );
        $rules = array(
            'firstname' =>  'required|min:4|max:50',
            'lastname' =>  'required|min:4|max:50',
            'phone_number' =>  'required|numeric|digits:10',
            'email' =>  'required|email|unique:user,email,' . $user->id
        );

        $valid = Validator::make($data, $rules);
        if($valid->fails()){
            return redirect('/profielwijzigen')->withErrors($valid)->withInput($data);
        }
        $user->update($data);

        $request->session()->flash('alert-success', 'Uw profiel is gewijziged.');
        return redirect('/profielwijzigen');
    }

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the ID from the route, checks if the given values are validated and changes the users password if they do.
     */
    public function editPassword(Request $request){
        $id = Route::current()->getParameter('id');
        $user = User::where('id',$id)->first();
        $data = array(
            'password'                  =>  $request['password'],
            'password_confirmation'     =>  $request['password_confirmation']
        );
        $rules = array(
            'password'              =>  'required|min:4|confirmed',
            'password_confirmation' =>  'required|min:4'
        );

        $valid = Validator::make($data,$rules);
        if($valid->fails()){
            return redirect('/profielwijzigen#tab_1_3')->withErrors($valid);
        }
        array_forget($data,'password_confirmation');
        $data['password'] = Hash::make($data['password']);

        $user->update($data);
        $request->session()->flash('alert-success', 'Uw wachtwoord is gewijziged.');
        return redirect('/profielwijzigen#tab_1_3');
    }

    /**
     * @author Stefano Groenland
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the ID of the route, looks for the useracount with the given ID and changes the profile picture of it.
     * It also deletes the past profile picture with the unlink() function.
     */
    public function editProfilePhoto(Request $request){
        $id = Route::current()->getParameter('id');
        $find = User::find($id);
        if(!$find->profile_photo == ""){
            unlink($find->profile_photo);
        }
        $this->upload($request,$id,2);
        $request->session()->flash('alert-success', 'Uw profielfoto is gewijziged');
        return redirect('/profielwijzigen#tab_1_2');
    }
}

