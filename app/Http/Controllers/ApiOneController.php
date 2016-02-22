<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdLocation;

class ApiOneController extends Controller
{
    /**
     * @var string
     * @return API key in string fromat
     *
     * Defines the API key for a security layer.
     */

    private static $apikey = "alpha";

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
        return "none";
    }

}
