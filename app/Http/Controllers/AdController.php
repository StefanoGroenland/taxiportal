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
        return View::make('/reclamewijzigen', compact('id', 'obj'));
    }

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     * Makes the reclametoevoegen view.
     */
    public function showAdsAdd(){
        return View::make('/reclametoevoegen');
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

        $data = array(
            'link'              => $request['link'],
            'central_location'  =>  $request['locatie'],
            'radius'            =>  $request['radius']
        );

        $rules = array(
            'link'              => 'required',
            'central_location'  => 'required',
            'radius'            => 'required|numeric'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclametoevoegen')->withErrors($validator)->withInput($data);
        }
        $advertisement = Ad::create($data);
        $this->upload($request,$advertisement->id);

        $dataLocation = array(
            'ad_id'     => $advertisement->id,
            'location'  => $request['locatie']
        );
        $geo = $this->geoCode($dataLocation['location']);

        $in_radius = $this->getLocationsInRadius($request['radius'],$geo[0],$geo[1]);

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
        $data = array(
            'link'              => $request['link'],
            'central_location'  =>  $request['locatie'],
            'radius'            =>  $request['radius']
        );

        $rules = array(
            'link'              => 'required',
            'central_location'  => 'required',
            'radius'            => 'required|numeric'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclamewijzigen/'.$id)->withErrors($validator)->withInput($data);
        }

        Ad::where('id', '=', $id)->update($data);
        AdLocation::deleteLocals($id);
        $this->upload($request,$id);

        $dataLocation = array(
            'ad_id'     => $id,
            'location'  => $request['location']
        );
        $geo = $this->geoCode($dataLocation['location']);

        $in_radius = $this->getLocationsInRadius($request['radius'],$geo[0],$geo[1]);

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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Grabs the file named 'profile_photo' from the request and uploads it onto the server,
     * It updates the corresponding newspaper with the link to the uploaded picture as their profile_photo in the Newspaper table.
     */
    public function upload(Request $request , $id){

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
                $img = Image::make($ava)->fit(1280, 135)->save();
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

	 	//data from reclameprofiel
        $year = "2016";
        $month = '03';
        $day= "23";

        $id = Route::current()->getParameter('id');
        $ad = Ad::where('id',$id)->first();
        $array_maanden = array('01' => 'jan', '02' => 'feb', '03' => 'maa', '04' => 'apr', '05' => 'mei','06' => 'jun','07' => 'jul','08' => 'aug','09' => 'sep','10' => 'okt','11' => 'nov','12' => 'dec');
        $clicks = AdClick::
        	where('ad_id', $id)
	        //->whereYear('created_at', '=', $year)
	        ->whereMonth('created_at', '=', $month)
	        // ->whereDay('created_at', '=', $day)
	        ->get();
        $clickFirst = AdClick::where('ad_id',$id)->first();

        //Years
        $clickCount = array();
        foreach($clicks as $click){
            @$clickCount[date('d-m-Y',strtotime($click->created_at))]++;
        }
       
        //month
        $list=array();

        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                $list[]=date('d-m-Y', $time);
        }

        foreach($array_maanden as $key => $maand){

           ${$maand.'Clicks'} = count($clickFirst::whereMonth('created_at','=',$key)->get());
        }

        //weeks
		$dt = Carbon::parse($year.'-'.$month.'-'.$day);
		$week_number = $dt->weekOfYear;
		$year = $dt->year;
		$dagen_week=array();
		for($day=1; $day<=7; $day++)
		{
		   $dagen_week[]= date('d-m-Y', strtotime($year."W".$week_number.$day));
		}

		
        return View::make('/reclameprofiel', compact('id','ad','allClicks','dagen_week','array_maanden','month','list','clickCount','janClicks','febClicks','maaClicks','aprClicks','meiClicks','junClicks','julClicks','augClicks','sepClicks','oktClicks','novClicks','decClicks'));
    }




    /**
     * @author Stefano Groenland
     * @param $adress
     * @return array
     *
     * Uses the Google maps Geocoding API to convert a location to geodata.
     */
    public function geoCode($adress){
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$adress.',NL&key=AIzaSyAKW-_1s45jicXozxFSRolEJpQIFSmC7NM';
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
