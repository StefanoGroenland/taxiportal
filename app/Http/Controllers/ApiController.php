<?php

namespace App\Http\Controllers;


use App\AdClick;
use App\Taxibase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\AdLocation;
use App\User;
use App\Tablet;
use App\Driver;
use App\Ad;
use App\Route;
use App\Newspaper;
use App\Emergency;
use App\Taxi;
use App\Comment;
use App\Route as RouteR;
use Illuminate\Http\Response as Response;

use Illuminate\Support\Facades\Input;
class ApiController extends Controller
{
    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @var string
     * @return API key in string format
     *
     * Defines the API key for a security layer
     */
    private static $apikey = "alpha";

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @var array
     * @return error message and api version
     *
     * Defines the error and current version, if the api key used is invalid
     */
    private static $error = array(
        'success'       =>  false,
        'error'         => 'Wrong API key used, access denied.',
        'api-version'   => '1.0',
        'status'        => '401'
    );

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @var array
     *
     * Defines the none error in other words the Four oh Four.
     */
    private static $none = array(
        'success'       =>  false,
        'error'         =>  'Whoops, we could not find any.',
        'status'        =>  '404'
    );

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns information about the given location
     */
    public function adsPerLocation()
    {
        $location   = Input::get('location');
        $key        = Input::get('key');

        if(!empty($location)){
            if ($key == self::$apikey) {
                $results = AdLocation::with('ad')->where('location', '=', $location)->get();
                if($results->isEmpty()){
                    return response()->json(self::$none, 404);
                }else{
                    return response()->json(array(
                        'advertisements'    =>  $results,
                        'success'           =>  true,
                        'action'            =>  'get_ads_for_location',
                        'status'            =>  '200'
                    ),200);
                }
            }
            return response()->json(self::$error, 401);
        }
        return response()->json(array(
            'success'   =>  false,
            'info'      =>  'Check if all parameters are filled in',
            'status'    =>  '400'
        ),400);
    }


    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns the advertisements for the given type
     */
    public function adsByType()
    {
        $type       = Input::get('type');
        $location   = Input::get('location');
        $key        = Input::get('key');

        if(!empty($type) && !empty($location)){
            if ($key == self::$apikey) {
                $results = AdLocation::with('ad')->where('location', '=', $location)->get();

                $response = array();
                foreach($results as $key => $value){
                    if($value->ad->type == $type){
                        $response[] = $value;
                    }
                }

                if($results->isEmpty()){
                    return response()->json(self::$none, 404);
                }else{
                    return response()->json(array(
                        'advertisements'    =>  $response,
                        'success'           =>  true,
                        'action'            =>  'get_ads_for_location_and_type',
                        'status'            =>  '200'
                    ),200);
                }
            }
            return response()->json(self::$error, 401);
        }
        return response()->json(array(
            'success'   =>  false,
            'info'      =>  'Check if all parameters are filled in',
            'status'    =>  '400'
        ),400);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @return \Illuminate\Http\JsonResponse
     *
     * returns success if succesfully updated the click count
     */
    public function increaseClickOfAd()
    {
            $id         = Input::get('id');
            $key        = Input::get('key');
            $ad         = Ad::with('adClicks')->where('id',$id)->first();
            $today      = date('Y-m-d');

            if(!empty($id)){
                if ($key == self::$apikey) {
                    $adclicks = AdClick::where('ad_id',$ad->id)
                                    ->whereDate('created_at','=',$today)->first();
                    if(count($adclicks) > 0){
                        $adclicks->update([
                            'clicks'    =>  $adclicks->clicks + 1
                        ]);
                    }else{
                        AdClick::create([
                            'ad_id'     =>  $ad->id,
                            'clicks'    =>  1
                        ]);
                    }
                    return response()->json(array(
                        'success'   =>  true,
                        'action'    =>  'increase_ad_click_count',
                        'status'    =>  '200'
                    ));
                }
                return response()->json(self::$error, 401);
            }else{
                return response()->json(array(
                    'success'   =>  false,
                    'info'      =>  'Check if all parameters are filled in',
                    'status'    =>  '400'
                ),400);
            }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns the driver associated with the Tablet
     */
    public function getDriverOffTablet()
    {
        $tablet     = Input::get('tablet_name');
        $key        = Input::get('key');
        if(!empty($tablet)){
            if ($key == self::$apikey) {
                $user = User::where('tablet_name', '=', $tablet)->first();
                $tablet = Tablet::with('taxi')->where('user_id', '=', $user->id)->first();
                $driver = Driver::where('id', '=', $tablet->taxi->driver_id)->first();
                $user   = User::where('id',$driver->user_id)->first();

                $rowCount = 0;
                $stars = 0;
                $allComments = Driver::with('comment')->where('id',$driver->id)->get();
                foreach($allComments as $comm){
                        foreach($comm->comment as $comment){
                            if($comment->approved > 0){
                                $stars += $comment->star_rating;
                                $rowCount+= count($comment->star_rating);
                            }
                        }
                }
                if($rowCount > 0){
                    $driverStars = $stars / $rowCount;
                    $user->stars = $driverStars;
                }

                return response()->json(array(
                    'driver'    =>  $driver,
                    'user'      =>  $user,
                    'success'   =>  true,
                    'action'    =>  'get_driver_off_tablet',
                    'status'    =>  '200'
                ),200);
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all routes from our Database in JSON format
     */
    public function getRoutes()
    {
        $key        = Input::get('key');
        $today      = date('Y-m-d');
        $all_routes = RouteR::all();
        $routeArray = array();

        if ($key == self::$apikey) {
            foreach($all_routes as $route){
                if(date('Y-m-d',strtotime($route->pickup_time)) == $today){
                    $routeArray[] = $route;
                }
            }
            if(count($routeArray) < 1){
                return response()->json(self::$none, 404);
            }else{
                return response()->json(array(
                    'routes'    =>  $routeArray,
                    'success'   =>  true,
                    'action'    =>  'get_all_routes',
                    'status'    =>  '200'
                ),200);
            }
        }
        return response()->json(self::$error, 401);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all routes for the specified taxi ID in JSON format
     */
    public function getRoutesForTaxi()
    {
        $taxiId     = Input::get('taxi_id');
        $key        = Input::get('key');
        $today      = date('Y-m-d');
        $all_routes = RouteR::where('taxi_id',$taxiId)->get();
        $routeArray = array();

        if(!empty($taxiId)){
            if ($key == self::$apikey) {
                foreach($all_routes as $route){
                    if(date('Y-m-d',strtotime($route->pickup_time)) == $today){
                        $routeArray[] = $route;
                    }
                }
                if(count($routeArray) < 1){
                    return response()->json(self::$none, 404);
                }else {
                    return response()->json(array(
                        'routes'    => $routeArray,
                        'success'   => true,
                        'action'    => 'get_routes_for_current_taxi',
                        'status' => '200'
                    ), 200);
                }
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all newsfeed links in JSON format
     */
    public function getNewsfeeds()
    {
        $key = Input::get('key');
        if ($key == self::$apikey) {
            $news = Newspaper::all();
            if($news->isEmpty()){
                return response()->json(self::$none, 404);
            }else{
                return response()->json(array(
                    'news'  =>  $news,
                    'success'   =>  true,
                    'action'    =>  'get_news_feeds',
                    'status'    =>  '200'
                ),200);
            }
        }
        return response()->json(self::$error, 401);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Updates a row in the 'Emergency' table with current location of the taxi sending it.
     */
    public function sendSOS()
    {
        $id         = Input::get('taxi_id');
        $last_lat   = Input::get('lat');
        $last_long  = Input::get('lng');
        $key        = Input::get('key');

        if(!empty($id) && !empty($last_lat) && !empty($last_long)){
            if ($key == self::$apikey) {
                Emergency::where('taxi_id',$id)->update(array('taxi_id' => $id, 'seen' => '0'));

                Taxi::where('id', '=', $id)->update(
                    array('last_latitude' => $last_lat,
                        'last_longtitude' => $last_long
                    ));
                return response()->json(array(
                    'success'   => true,
                    'action'    => 'emergency_signal_send',
                    'status'    =>  '200'
                ), 200);
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }


    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Support\Collection|\Illuminate\Http\JsonResponse
     *
     * Looks for the relations of a given tablet name if the tablet name exists in the DB,
     * Returns data from the tablet , the related driver and taxi
     */
    public function tabletLogin()
    {
        $tablet_name    = Input::get('tablet_name');
        $key            = Input::get('key');
        if(!empty($tablet_name)) {
            if ($key == self::$apikey) {
                $tablet = User::with('tablet')->where('tablet_name', '=', $tablet_name)->first();
                $exists = count($tablet);

                if ($exists > 0) {
                    $taxi = Taxi::with('driver')->where('id', '=', $tablet->tablet->taxi_id)->first();
                    $user = User::where('id',$taxi->driver->user_id)->first();
                    $result = collect([
                        array('tablet' => $tablet),
                        array('taxi_with_driver' => $taxi),
                        array('taxi_user' => $user)
                    ]);
                    if(count($taxi) < 1 || count($user) < 1){
                        return response()->json(self::$none, 404);
                    }else{
                        return response()->json(array(
                            'result'    =>  $result,
                            'success'   =>  true,
                            'action'    =>  'tablet_login',
                            'status'    =>  '200'
                        ),200);
                    }
                }
                return response()->json(self::$none, 404);
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return string|static|\Illuminate\Http\JsonResponse
     *
     * Let's the tablet post a comment for the corresponding driver to the database with a star rating
     */
    public function postComment()
    {
        $driver     = Input::get('driver_id');
        $message    = Input::get('message');
        $stars      = Input::get('stars');
        $key        = Input::get('key');

        if(!empty($driver) && !empty($message) && !empty($stars)) {
            if ($key == self::$apikey) {
                $data = array(
                    'driver_id'     => $driver,
                    'comment'       => $message,
                    'approved'      => 0,
                    'star_rating'   => $stars);
                Comment::create($data);

                return response()->json(array(
                    'success'   => true,
                    'action'    => 'comment_posted',
                    'status'    => '200'
                ), 200);
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return string|static|\Illuminate\Http\JsonResponse
     *
     * Checks if there are any last_seen values with a difference of 20 minutes at the current time when calling this method.
     * if this is true, it will create an row in the database with the related taxi id
     */
    public function signalCheck()
    {
        $taxis = Taxi::where('in_shift', '=', 1)->get();

        foreach ($taxis as $taxi) {
            $last = Carbon::createFromFormat('Y-m-d H:i:s', $taxi->last_seen);
            $diff = $last->diffInMinutes(Carbon::now()->addMinutes(7));
            if ($diff >= 20){
                if(!Emergency::where('taxi_id',$taxi->id)->where('seen',0)->exists()){
                    Emergency::create(array('taxi_id' => $taxi->id, 'seen' => 0));
                }
        }
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return static|\Illuminate\Http\JsonResponse
     *
     * Get all Emergency rows from the database.
     */
    public function getSOS()
    {
        $emergencies = Emergency::with('taxi')->where('seen', 0)->get();
        if (count($emergencies) > 0) {
            foreach ($emergencies as $sos) {
                if ($sos->taxi) {
                    $sosArray[] = array('sos' => 'true', 'taxi_license_plate' => $sos->taxi->license_plate,
                        'last_seen' => $sos->taxi->last_seen);
                }
            }
            return response()->json($sosArray);
        }
        return response()->json(['sos' => 'false']);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Gets all comments for the given driver.
     */
    public function getCommentsOffDriver(){
        $driverID   = Input::get('driver_id');
        $key        = Input::get('key');

        if(!empty($driverID)) {
            if ($key == self::$apikey) {
                $comment = Comment::where('driver_id', $driverID)->where('approved', 1)->get();
                if($comment->isEmpty()){
                    return response()->json(self::$none, 404);
                }else{
                    return response()->json(array(
                        'comments'  =>  $comment,
                        'success'   =>  true,
                        'action'    =>  'comments_off_driver',
                        'status'    =>  '200'
                    ),200);
                }
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Updates the taxi location with the given params
     */
    public function sendLocation(){
        $driverID   = Input::get('driver_id');
        $latitude   = Input::get('lat');
        $longtitude = Input::get('lng');
        $key        = Input::get('key');
        $datetime = date('Y-m-d H:i:s');
        if(!empty($driverID) && !empty($latitude) && !empty($longtitude)) {
            if ($key == self::$apikey) {
                    $find = Taxi::where('driver_id', $driverID)->first();
                    if(count($find) < 1){
                        return response()->json(self::$none, 404);
                    }else{
                        $find->update([
                            'last_latitude'     => $latitude,
                            'last_longtitude'   => $longtitude,
                            'last_seen'         => $datetime
                        ]);
                    }
                return response()->json(array(
                    'success'   =>  true,
                    'action'    =>  'current_location_coords_send',
                    'status'    =>  '200'
                ),200);
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Updates the shift value of the given taxi, changes it to true so the taxi is in shift.
     */
    public function inShift(){
        $taxiID     = Input::get('taxi_id');
        $key        = Input::get('key');

        if(!empty($taxiID)) {
            if ($key == self::$apikey) {
                $car = Taxi::where('id', $taxiID)->first();
                if(count($car) < 1){
                    return response()->json(self::$none, 404);
                }else{
                    $car->update(['in_shift' => 1]);

                    return response()->json(array(
                        'success'   =>  true,
                        'action'    =>  'shift_value_changed',
                        'value'     =>  $car->in_shift,
                        'status'    =>  '200'
                    ),200);
                }
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Updates the shift value of the given taxi, changes it to false so the taxi is off shift.
     */
    public function offShift(){
        $taxiID     = Input::get('taxi_id');
        $key        = Input::get('key');

        if(!empty($taxiID)) {
            if ($key == self::$apikey) {
                $car = Taxi::where('id', $taxiID)->first();
                if(count($car) < 1){
                    return response()->json(self::$none, 404);
                }else{
                    $car->update(['in_shift' => 0]);

                    return response()->json(array(
                        'success'   =>  true,
                        'action'    =>  'shift_value_changed',
                        'value'     =>  $car->in_shift,
                        'status'    =>  '200'
                    ),200);
                }
            }
            return response()->json(self::$error, 401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Uses a ton of inputs to define the return route and request it.
     * It will create a row in the database and the admins need to assign them to a driver,
     * if possible.
     */
    public function requestReturnRide()
    {
        $key            = Input::get('key');
        $start_city     = Input::get('start_city');
        $start_zip      = Input::get('start_zip');
        $start_numb     = Input::get('start_number');
        $start_street   = Input::get('start_street');
        $end_city       = Input::get('end_city');
        $end_zip        = Input::get('end_zip');
        $end_numb       = Input::get('end_number');
        $end_street     = Input::get('end_street');
        $pickup_time    = Input::get('pickup_time');
        $phone_cust     = Input::get('phone_customer');
        $email_cust     = Input::get('email_customer');

        if( !empty($start_city)     &&
            !empty($start_zip)      &&
            !empty($start_numb)     &&
            !empty($start_street)   &&
            !empty($end_city)       &&
            !empty($end_zip)        &&
            !empty($end_numb)       &&
            !empty($end_street)     &&
            !empty($pickup_time)    &&
            !empty($phone_cust)     &&
            !empty($email_cust)
        ) {
            if ($key == self::$apikey) {
                RouteR::create([
                    'start_city'        => $start_city,
                    'start_zip'         => $start_zip,
                    'start_number'      => $start_numb,
                    'start_street'      => $start_street,

                    'end_city'          => $end_city,
                    'end_zip'           => $end_zip,
                    'end_number'        => $end_numb,
                    'end_street'        => $end_street,

                    'pickup_time'       => $pickup_time,
                    'phone_customer'    => $phone_cust,
                    'email_customer'    => $email_cust
                ]);
                return response()->json(array(
                    'success'   => true,
                    'action'    => 'return_ride_requested',
                    'status'    => '200'
                ), 200);
            }
            return response()->json(self::$error, 401);
        }else{
                return response()->json(array(
                    'success'   =>  false,
                    'info'      =>  'Check if all parameters are filled in',
                    'status'    =>  '400'
                ),400);
            }
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Uses the given inputs to create a new location in the DB for the google maps base markers.
     */
    public function postBase(){
        $key    = Input::get('key');
        $lat    = Input::get('lat');
        $long   = Input::get('lng');
        $name   = Input::get('base_name');

        if(!empty($lat) && !empty($long) && !empty($name)){
            if($key == self::$apikey){
                Taxibase::create([
                    'latitude'      => $lat,
                    'longtitude'    => $long,
                    'base_name'     => $name
                ]);
                return response()->json(array(
                    'success'   =>      true,
                    'action'    =>      'base_added',
                    'status'    =>      '200'
                ),200);
            }
            return response()->json(self::$error,401);
        }else{
            return response()->json(array(
                'success'   =>  false,
                'info'      =>  'Check if all parameters are filled in',
                'status'    =>  '400'
            ),400);
        }

    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return mixed
     *
     * Returns all locations of the current in shift taxi's where they have coordinates stored in the DB.
     */
    public function getLocations(){
         $key = Input::get('key');

        if($key == self::$apikey){
            $cars = Taxi::with('driver','emergency')->where('in_shift',1)->where('last_latitude','!=','')->where('last_longtitude','!=','')->get();

            return response()->json(array(
                'cars' =>  $cars
            ),200);
        }
     return response()->json(self::$error,401);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return mixed
     *
     * Returns all locations of the defined bases stored in the DB.
     */
    public function getBaseLocations(){
        $key = Input::get('key');

        if($key == self::$apikey){
            $bases = Taxibase::all();

            return response()->json(array(
                'bases' =>  $bases
            ),200);
        }
        return response()->json(self::$error,401);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return mixed
     *
     * Returns the given taxi's `in_shift` value
     */
    public function getShiftState(){
        $key = Input::get('key');
        $taxi_id = Input::get('taxi_id');

        if($key == self::$apikey){
            $current = Taxi::where('id',$taxi_id)->first();
            if(is_null($current)){
                return response()->json([
                    'error' =>  'not_found'
                ],404);
            }else{
                return response()->json(array(
                   'shift_val'  =>  $current->in_shift
                ),200);
            }
        }
        return response()->json(self::$error,401);
    }

    /**
     * @author Stefano Groenland
     * @return string
     *
     * Uses the geobyte API for nearby cities in a radius arround the lat & long coords of a given location.
     */
    public function getLocationsInRadius(){
        $radius = Input::get('radius');
        $lat = Input::get('lat');
        $lng = Input::get('lng');

        $radius = $radius * 0.62137; //km to miles
        $url = 'http://gd.geobytes.com/GetNearbyCities?radius='.$radius.'&Latitude='.$lat.'&Longitude='.$lng.'&limit=999';

        $response_json = file_get_contents($url);

        $response = json_decode($response_json, true);

        return $response;
    }

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Returns all clicks for the given year.
     */
    public function statisticsDataYear(){
        $year   = Input::get('year');
        $clicks = AdClick::whereYear('created_at','=',$year)->orderBy('created_at','asc')->get();

        return response()->json(array(
            'result'    =>  $clicks
        ));
    }

     /**
     * @author Richard Perdaan
     * @return mixed
     *
     * Returns all clicks for the given month.
     */
     public function statisticsDataMonth(){
        $month  = Input::get('month');
        $year   = Input::get('year');
        $clicks = AdClick::whereMonth('created_at','=',$month)->whereYear('created_at','=',$year)->orderBy('created_at', 'asc')->get();

        return response()->json(array(
            'result'    =>  $clicks    
        )); 

     }
      /**
     * @author Richard Perdaan
     * @return mixed
     *
     * Returns all clicks for the given month.
     */
     public function statisticsDataWeek(){
        $week   = Input::get('week');
        $year   = Input::get('year');
       
        $response = array();
       
        $clicks = AdClick::whereYear('created_at','=',$year)
        ->orderBy('created_at', 'asc')
        ->get();

        foreach ($clicks as $key => $value) {

            if($value->created_at->format('W') == $week){
                $response[] = $value;
            }
        }

        return response()->json(array(
            'result'    =>  $response
        )); 
     }

}

