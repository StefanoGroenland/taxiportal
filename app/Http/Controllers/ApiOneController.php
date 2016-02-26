<?php

namespace App\Http\Controllers;


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

use Illuminate\Support\Facades\Input;
class ApiOneController extends Controller
{
    /**
     * @var string
     * @return API key in string fromat
     *
     * Defines the API key for a security layer
     */
    private static $apikey = "alpha";
    /**
     * @var array
     * @return error message and api version
     *
     * Defines the error and current version, if the api key used is invalid
     */
    private static $error = array(
        'error'     =>  'api-key-invalid',
        'api-version'   =>  '1.0'
    );

    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @param $location
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns information about the given location
     */
    public function adsPerLocation($location,$key){
        $apikey = self::$apikey;
        if($key == $apikey){
            $results = AdLocation::with('ad')->where('location','=',$location)->get();
            return $results->toJson();
        }
        return json_encode(self::$error[0]);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @return \Illuminate\Http\JsonResponse
     *
     * returns success if succesfully updated the click count
     */
    public function increaseClickOfAd(){
        $id = Input::get('id');
        $key = Input::get('key');
        $ad = Ad::find($id);
        $clicks = $ad->clicks;
        $succeed = array('result' => 'success');
        $apikey = self::$apikey;
            if($key == $apikey){
                Ad::where('id',$ad->id)->update(array('clicks' => $clicks + 1));
                return json_encode($succeed);
            }
            return json_encode(self::$error[0]);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @param $tablet
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns the driver associated with the Tablet
     */
    public function getDriverOffTablet($tablet,$key)
    {
        $apikey = self::$apikey;
        if($key == $apikey){
            //Looks for the given tablet name.
            $user = User::where('tablet_name','=',$tablet)->first();
            //Looks for the associated taxi in the tablet table.
            $tablet = Tablet::with('taxi')->where('user_id','=',$user->id)->first();
            //Looks for the driver with the user_id of the Taxi.driver_id
            $driver = Driver::with('user')->where('user_id','=',$tablet->taxi->driver_id)->first();
            //If found return in JSON format.
            return $driver->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all routes from our Database in JSON format
     */
    public function getRoutes($key){
        $apikey = self::$apikey;
        if($key == $apikey){
            $routes = Route::all();
            return $routes->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @param $taxiId
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all routes for the specified taxi ID in JSON format
     */
    public function getRoutesForTaxi($taxiId, $key){
        $apikey = self::$apikey;
        if($key == $apikey){
            $routes = Route::where('taxi_id',$taxiId)->get();
            return $routes->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all newsfeed links in JSON format
     */
    public function getNewsfeeds($key){
        $apikey = self::$apikey;
        if($key == $apikey){
            $news = Newspaper::all();
            return $news->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Creates a row in the 'Emergency' table with current location of the taxi sending it.
     * returns a JSON object if sending succeeds
     */
    public function sendSOS(){
        $id = Input::get('id');
        $last_lat = Input::get('latitude');
        $last_long = Input::get('longtitude');
        $key = Input::get('key');

        $succeed = array('result' => 'success');
        $apikey = self::$apikey;
        if($key == $apikey){
              Emergency::create(array('taxi_id' => $id, 'seen' => '0'));

              Taxi::where('id','=',$id)->update(
                  array('last_latitude' => $last_lat,
                  'last_longtitude' => $last_long
              ));
            return json_encode($succeed);
        }
        return json_encode(self::$error);
    }


    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @return \Illuminate\Support\Collection|\Illuminate\Http\JsonResponse
     *
     * Looks for the relations of a given tablet name if the tablet name exists in the DB,
     * Returns data from the tablet , the related driver and taxi
     */
    public function tabletLogin(){
        $tablet_name = Input::get('tablet_name');
        $key = Input::get('key');
        $apikey = self::$apikey;
        if($key == $apikey) {
            $tablet = User::with('tablet')->where('tablet_name', '=', $tablet_name)->first();
            $exists = count($tablet);

            if($exists > 0){
                $taxi = Taxi::with('driver')->where('id','=',$tablet->tablet->taxi_id)->first();
                $result = collect([$tablet,$taxi,$taxi->driver->user]);
                return $result;
            }
            return json_encode(array('error' => 'no_tablet_found', 'api-version' => '1.0'));
        }
        return json_encode(self::$error);
    }


}
