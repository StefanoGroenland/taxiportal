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
    public function showAds(){
        $ads = Ad::with('adLocation')->get();
        return View::make('/reclames', compact('ads'));
    }
    public function showAdsEdit(){
        $adID = Route::current()->getParameter('id');
        return View::make('/reclamewijzigen', compact('adID'));
    }
    public function showAdsAdd(){
        return View::make('/reclametoevoegen');
    }
    public function addAd(Request $request){
       
        $data = array(
            'link' => $request['link'],
            'banner' => $request['banner']
        );

        $rules = array(
            'link' => 'required',
            'banner' => '',
        );
        $rulesLocation = array('location' => 'required');

        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclametoevoegen')->withErrors($validator)->withInput($data);
        }  

        $advertisement = Ad::create($data);
        $dataLocation = array(
            'ad_id' => $advertisement->id,
            'location' => $request['locatie']
        );
        AdLocation::create($dataLocation);
        return redirect()->route('reclames');
    }
    public function deleteAd(Request $request){
       $id = Route::current()->getParameter('id');
       $find = Ad::find($id);
       Ad::where('id','=',$id)->delete();
       AdLocation::where('ad_id','=',$id)->delete();
       session()->flash('alert-success', 'reclame' . $find->link.' verwijderd.');
       return redirect()->route('reclames'); 
    }
    public function editAd($id,Request $request){
        // $id = Route::current()->getParameter('id');
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
            return redirect('reclamewijzigen/'.$id)->withErrors($validator)->withInput($data);
        }
        Ad::where('id', '=', $id)->update($data);
        AdLocation::where('ad_id','=',$id)->update($data);
        $request->session()->flash('alert-success', 'Reclame ' . $request['link'] . 'is veranderd.');
        return redirect()->route('reclames'); 
    }
}
