<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Ad;
use App\AdLocation;
use App\adClick;
use Illuminate\Support\Facades\Validator;
use Image as Image;
use DB;
use Carbon\Carbon;

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
        $ads = Ad::with('adLocation','adClicks')->get();
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
        $type = Route::current()->getParameter('type');
        $obj = Ad::find($id);
        return View::make('/reclamewijzigen', compact('id', 'obj', 'type'));
    }

    public function showAdsPanel(){
        return View::make('/reclametype');
    }
    /**
     * @author Richard Perdaan
     * @return mixed
     *
     * Makes the reclametoevoegen view.
     */
    public function showAdsAdd(){
        $type = Route::current()->getParameter('type');
        return View::make('/reclametoevoegen', compact('type'));
    }

    /**
     * @author Richard Perdaan & Stefano Groenland
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Grabs all input values from the request, validates them and if all goes well,
     * The advertisement will be created.
     */
    public function addAd(Request $request){
        $type = Route::current()->getParameter('type');

        $data = array(
            'link'              => $request['link'],
            'central_location'  =>  $request['location'],
            'radius'            =>  $request['radius'],
            'type'              =>  $type,
            'title'             =>  $request['title']
        );
        if($type !== 'center'){
            array_forget($data,'title');
        }
        $rules = array(
            'link'              => 'required',
            'central_location'  => 'required',
            'radius'            => 'required|numeric'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclametoevoegen'.$type)->withErrors($validator)->withInput($data);
        }

        if($data['radius'] < 10){
            $data['radius'] = 10;
        }

        $advertisement = Ad::create($data);
        $this->upload($request,$advertisement->id,$type);
        $dataLocation = array(
            'ad_id'     => $advertisement->id,
            'location'  => $request['location']
        );
        $geo = $this->geoCode($dataLocation['location']);



        $in_radius = $this->getLocationsInRadius($data['radius'],$geo[0],$geo[1]);

        foreach($in_radius as $inbound){
            $cities[] = array(
              'city'    =>  $inbound[1],
              'lat'     =>  $inbound[8],
              'lng'     =>  $inbound[10]
            );
        }
        AdLocation::insertLocals($advertisement->id,$cities);

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
       $find->delete();
       if(!$find->logo == ""){
           unlink($find->logo);
       }
       AdLocation::where('ad_id','=',$id)->delete();
       Adclick::where('ad_id','=',$id)->delete();
       session()->flash('alert-success', 'reclame ' . $find->link.' verwijderd.');
       return redirect()->route('reclames');
    }

    /**
     * @author Richard Perdaan & Stefano Groenland
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * Uses the route parameter to define which advertisement has to be edited,
     * Gets all inputs filled in and checks them for validation.
     * If all passed correctly the advertisement gets updated.
     */
    public function editAd(Request $request){
        $id = Route::current()->getParameter('id');
        $type = Route::current()->getParameter('type');
        $data = array(
            'link'              => $request['link'],
            'central_location'  =>  $request['location'],
            'radius'            =>  $request['radius'],
            'title'             =>  $request['title']
        );
        if($type !== 'center'){
            array_forget($data,'title');
        }
        $rules = array(
            'link'              => 'required',
            'central_location'  => 'required',
            'radius'            => 'required|numeric'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclamewijzigen/'.$id.'/'.$type)->withErrors($validator)->withInput($data);
        }

        if($data['radius'] < 10){
            $data['radius'] = 10;
        }

        Ad::where('id', '=', $id)->update($data);
        AdLocation::deleteLocals($id);
        $this->upload($request,$id, $type);

        $dataLocation = array(
            'ad_id'     => $id,
            'location'  => $request['location']
        );
        $geo = $this->geoCode($dataLocation['location']);

        $in_radius = $this->getLocationsInRadius($data['radius'],$geo[0],$geo[1]);

        foreach($in_radius as $inbound){
            $cities[] = array(
                'city'    =>  $inbound[1],
                'lat'     =>  $inbound[8],
                'lng'     =>  $inbound[10]
            );
        }
        AdLocation::insertLocals($id,$cities);

        $request->session()->flash('alert-success', 'Reclame ' . $request['link'] . ' is veranderd.');
        return redirect()->route('reclames');
    }

    /**
     * @authors Stefano Groenland
     * @param Request $request
     * @param $id
     * @param $type
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the file named 'banner' from the request and uploads it onto the server,
     * It updates the corresponding advertisement with the link to the uploaded picture as their banner in the Ad table.
     */
    public function upload(Request $request , $id, $type){
        $fitW = 0;
        $fitH = 0;
        switch($type){
            case "bottom":
                $fitW   =     1280;
                $fitH   =     135;
                break;
            case "center":
                $fitW   =     340;
                $fitH   =     200;
                break;
            case "side":
                $fitW   =     160;
                $fitH   =     600;
                break;
        }

        $x = $request['x'];
        $y = $request['y'];
        $h = $request['h'];
        $w = $request['w'];

        $file = array('banner' => $request->file('banner'));
        $rules = array('banner' => 'required|mimes:jpeg,bmp,png,jpg',);
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            if ($file) {
                //$request->session()->flash('alert-danger', 'U heeft geen bestand / geen geldig bestand gekozen om te uploaden, voeg een foto toe.');
            }
            return redirect('/reclames');
        } else {
            if ($request->file('banner')->isValid()) {
                $destinationPath = 'assets/uploads';
                $extension = $request->file('banner')->getClientOriginalExtension();
                $fileName = rand(1111, 9999) . '.' . $extension;
                $request->file('banner')->move($destinationPath, $fileName);
                $ava = $destinationPath . '/' . $fileName;
                $img = Image::make($ava)->fit($fitW, $fitH)->save();
                $final = $destinationPath . '/' . $img->basename;
                Ad::uploadPicture($id, $final);
                return redirect('/reclames');

            } else {
                $request->session()->flash('alert-danger', 'Er is een fout opgetreden tijdens het uploaden van uw bestand.');
            }
        }

    }

    /**
     * @author Stefano Groenland
     * @param $radius
     * @param $lat
     * @param $lng
     * @return string
     *
     * Uses the geobyte API for nearby cities in a radius arround the lat & long coords of a given location.
     */
    public function getLocationsInRadius($radius,$lat,$lng){

        $radius = $radius * 0.62137; //km to miles
        $url = 'http://gd.geobytes.com/GetNearbyCities?radius='.$radius.'&Latitude='.$lat.'&Longitude='.$lng.'&limit=999';

        $response_json = file_get_contents($url);

        $response = json_decode($response_json, true);

        return $response;
    }


   
    /** 
     * @return mixed
     */
public function showAdStats(){

        $id = Route::current()->getParameter('id');
        $ad = Ad::where('id',$id)->first();
        return View::make('/reclameprofiel', compact('id','ad'));
    }




    /**
     * @author Stefano Groenland
     * @param $adress
     * @return array
     *
     * Uses the Google maps Geocoding API to convert a location to geodata.
     */
    public function geoCode($adress){
        //We do not need any person filling in more locations so we build an array of all word.
        //And only use the first word in the $url
        $adressArray = str_word_count($adress,1);

        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$adressArray[0].',NL&key=AIzaSyAKW-_1s45jicXozxFSRolEJpQIFSmC7NM';
        $response_json = file_get_contents($url);

        $response = json_decode($response_json, true);

        if($response['status'] == 'OK'){
            $lat = $response['results'][0]['geometry']['location']['lat'];
            $lng = $response['results'][0]['geometry']['location']['lng'];

            if(!empty($lat) && !empty($lng)){
                $result = array();
                array_push($result,$lat,$lng);
                return $result;
            }
        }
    }
}
