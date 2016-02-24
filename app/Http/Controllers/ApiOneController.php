<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdLocation;
use App\User;
use App\Tablet;
use App\Driver;
use App\Ad;
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
        'error'     =>  'API-Key invalid',
        'version'   =>  'v1.0'
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
     * @param $id
     * @param $key
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
}
