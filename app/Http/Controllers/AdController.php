<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Ad;
use App\AdLocation;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Gets all ads from the database with atleast one location linked to it,
     * and passes them along when making the view.
     */
    public function showAds(){
        $ads = Ad::with('adLocation')->get();
        return View::make('/reclames', compact('ads'));
    }

    /**
     * @authors Stefano Groenland , Richard Perdaan
     * @return mixed
     *
     * Gets the corresponding advertisement of the route id passed,
     * Gets all locations comma from the database and places them comma delimited in a variable for later use.
     */
    public function showAdsEdit(){
        $id = Route::current()->getParameter('id');
        $obj = Ad::find($id);
        $objLo = AdLocation::where('ad_id',$obj->id)->get();

        $locations = '';
        foreach($objLo as $key => $value){
            $locations .= $value->location.',';
        }

        $locations = rtrim($locations, ',');


        return View::make('/reclamewijzigen', compact('id', 'obj', 'locations'));
    }

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     *  TODO : fill in func description
     */
    public function showAdsAdd(){
        return View::make('/reclametoevoegen');
    }

    /**
     * @author Richard Perdaan
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Grabs all input values from the request, validates them and if all goes well,
     * The advertisement will be created.
     */
    public function addAd(Request $request){
       
        $data = array(
            'link' => $request['link'],
            'banner' => $request['banner']
        );

        $rules = array(
            'link' => 'required',
            'banner' => '',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclametoevoegen')->withErrors($validator)->withInput($data);
        }
        $advertisement = Ad::create($data);
        $dataLocation = array(
            'ad_id' => $advertisement->id,
            'location' => $request['locatie']
        );

        $datLoc = $dataLocation['location'];
        $datLocArray = explode(',',$datLoc);
        for($i = 0; $i < count($datLocArray); $i++){
            AdLocation::insertLocals($advertisement->id,$datLocArray[$i]);
        }
        session()->flash('alert-success', 'reclame ' . $advertisement->link.' toegevoegd.');
        return redirect()->route('reclames');
    }

    /**
     * @author Richard Perdaan
     * @return \Illuminate\Http\RedirectResponse
     *
     * Gets the id from the route parameter,
     * looks for the id in the database. If found the row will be deleted from the Ad table,
     * Aswell as the linked rows in the AdLocation table.
     */
    public function deleteAd(){
       $id = Route::current()->getParameter('id');
       $find = Ad::find($id);
       Ad::where('id','=',$id)->delete();
       AdLocation::where('ad_id','=',$id)->delete();
       session()->flash('alert-success', 'reclame ' . $find->link.' verwijderd.');
       return redirect()->route('reclames'); 
    }

    /**
     * @author Richard Perdaan
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Uses the route parameter to define which advertisement has to be edited,
     * Gets all inputs filled in and checks them for validation.
     * If all passed correctly the advertisement gets updated.
     */
    public function editAd(Request $request){
        $id = Route::current()->getParameter('id');
        $data = array(
            'link' => $request['link'],
            'banner' => $request['banner']
        );
         $rules = array(
            'link' => 'required',
            'banner' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclamewijzigen/'.$id)->withErrors($validator)->withInput($data);
        }

        Ad::where('id', '=', $id)->update($data);
        $dataLocation = array(
            'ad_id' => $id,
            'location' => $request['location']
        );
        $datLoc = $dataLocation['location'];
        $datLocArray = explode(',',$datLoc);
        for($i = 0; $i < count($datLocArray); $i++){
            if($i < 1){
                AdLocation::deleteLocals($id);
            }
            AdLocation::updateLocals($id,$datLocArray[$i]);
        }

        $request->session()->flash('alert-success', 'Reclame ' . $request['link'] . ' is veranderd.');
        return redirect()->route('reclames'); 
    }
}
