<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
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
        'error' => 'api-key-invalid',
        'api-version' => '1.0'
    );

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @param $location
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns information about the given location
     */
    public function adsPerLocation($location, $key)
    {
        $apikey = self::$apikey;
        if ($key == $apikey) {
            $results = AdLocation::with('ad')->where('location', '=', $location)->get();
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
    public function increaseClickOfAd()
    {
        $id = Input::get('id');
        $key = Input::get('key');
        $ad = Ad::find($id);
        $clicks = $ad->clicks;
        $succeed = array('result' => 'success');
        $apikey = self::$apikey;
        if ($key == $apikey) {
            Ad::where('id', $ad->id)->update(array('clicks' => $clicks + 1));
            return json_encode($succeed);
        }
        return json_encode(self::$error[0]);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @param $tablet
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns the driver associated with the Tablet
     */
    public function getDriverOffTablet($tablet, $key)
    {
        $apikey = self::$apikey;
        if ($key == $apikey) {
            $user = User::where('tablet_name', '=', $tablet)->first();
            $tablet = Tablet::with('taxi')->where('user_id', '=', $user->id)->first();
            $driver = Driver::with('user')->where('user_id', '=', $tablet->taxi->driver_id)->first();
            return $driver->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all routes from our Database in JSON format
     */
    public function getRoutes($key)
    {
        $apikey = self::$apikey;
        if ($key == $apikey) {
            $routes = Route::all();
            return $routes->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @param $taxiId
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all routes for the specified taxi ID in JSON format
     */
    public function getRoutesForTaxi($taxiId, $key)
    {
        $apikey = self::$apikey;
        if ($key == $apikey) {
            $routes = Route::where('taxi_id', $taxiId)->get();
            return $routes->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @param $key
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns all newsfeed links in JSON format
     */
    public function getNewsfeeds($key)
    {
        $apikey = self::$apikey;
        if ($key == $apikey) {
            $news = Newspaper::all();
            return $news->toJson();
        }
        return json_encode(self::$error);
    }

    /**
     * @author Stefano Groenland
     * @api
     * @version 1.0
     * @return \Illuminate\Http\JsonResponse
     *
     * Creates a row in the 'Emergency' table with current location of the taxi sending it.
     * returns a JSON object if sending succeeds
     */
    public function sendSOS()
    {
        $id = Input::get('id');
        $last_lat = Input::get('latitude');
        $last_long = Input::get('longtitude');
        $key = Input::get('key');

        $succeed = array('result' => 'success');
        $apikey = self::$apikey;
        if ($key == $apikey) {
            Emergency::create(array('taxi_id' => $id, 'seen' => '0'));

            Taxi::where('id', '=', $id)->update(
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
     * @version 1.0
     * @return \Illuminate\Support\Collection|\Illuminate\Http\JsonResponse
     *
     * Looks for the relations of a given tablet name if the tablet name exists in the DB,
     * Returns data from the tablet , the related driver and taxi
     */
    public function tabletLogin()
    {
        $tablet_name = Input::get('tablet_name');
        $key = Input::get('key');
        $apikey = self::$apikey;
        if ($key == $apikey) {
            $tablet = User::with('tablet')->where('tablet_name', '=', $tablet_name)->first();
            $exists = count($tablet);

            if ($exists > 0) {
                $taxi = Taxi::with('driver')->where('id', '=', $tablet->tablet->taxi_id)->first();
                $result = collect([array('tablet' => $tablet),
                    array('taxi' => $taxi),
                    array('taxi_user' => $taxi->driver->user)
                ]);
                return json_encode($result);
            }
            return json_encode(array('error' => 'no_tablet_found', 'api-version' => '1.0'));
        }
        return json_encode(self::$error);
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
        $driver = Input::get('driver_id');
        $message = Input::get('message');
        $stars = Input::get('stars');
        $key = Input::get('key');
        $apikey = self::$apikey;
        if ($key == $apikey) {
            $data = array(
                'driver_id' => $driver,
                'comment' => $message,
                'approved' => 0,
                'star_rating' => $stars);

            $result = Comment::create($data);
            return json_encode($result);
        }
        return json_encode(self::$error);
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
            $diff = $last->diffInMinutes(Carbon::now()->addMinutes(7));{
            if ($diff >= 20)
                return Emergency::create(array('taxi_id' => $taxi->id, 'seen' => 0));
            }
            return json_encode(['nothing' => 'all_good']);
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
            return json_encode($sosArray);
        }
        return json_encode(['sos' => 'false']);
    }
}

