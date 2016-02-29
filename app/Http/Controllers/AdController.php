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
