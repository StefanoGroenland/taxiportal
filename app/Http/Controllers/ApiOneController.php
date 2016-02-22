<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdLocation;

class ApiOneController extends Controller
{
    /**
     * @author Stefano Groenland
     * @api
     * @version v1.0
     * @param $location
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns information about the given location
     */
    public function adsPerLocation($location){
        $results = AdLocation::with('ad')->where('location','=',$location)->get();

        return $results->toJson();
    }
}
