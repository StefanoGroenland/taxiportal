<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AdLocation;
use App\User;

class ApiOneController extends Controller
{

    /**
     * @author Stefano Groenland
     * @api
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Returns information about the given user id.
     */
    public function getUser($id){

        $user = User::findOrFail($id);
        
        return response()->json(
            [
                'email'         => $user->email,
                'firstname'     => $user->firstname,
                'surname'       => $user->surname,
                'lastname'      => $user->lastname,
                'profile_photo' => $user->profile_photo,
                'user_rank'     => $user->user_rank,
                'created_at'    => $user->created_at
            ]
        );
    }

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
