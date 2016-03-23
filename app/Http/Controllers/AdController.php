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
            'link'      => $request['link']
        );

        $rules = array(
            'link'      => 'required'
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

        $datLoc = $dataLocation['location'];
        $datLocArray = explode(',',$datLoc);
        for($i = 0; $i < count($datLocArray); $i++){
            AdLocation::insertLocals($advertisement->id,trim($datLocArray[$i],' '));
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
       $find->delete();
       if(!$find->logo == ""){
           unlink($find->logo);
       }
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
            'link'      => $request['link'],
        );
         $rules = array(
            'link'      => 'required'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect('reclamewijzigen/'.$id)->withErrors($validator)->withInput($data);
        }

        Ad::where('id', '=', $id)->update($data);
        $this->upload($request,$id);

        $dataLocation = array(
            'ad_id'     => $id,
            'location'  => $request['location']
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

    public function getLocationsInRadius($radius,$lat,$lng){
            $radius = $radius * 0.62137; //km to miles
            $url = 'http://gd.geobytes.com/GetNearbyCities?radius='.$radius.'&Latitude='.$lat.'&Longitude='.$lng.'&limit=999';

            $response = file_get_contents($url);

//          Test code
//          $response = $this->getLocationsInRadius(0,51.946228,4.537657);
//          $response = json_decode($response, false);
//
//          foreach($response as $res){
//              echo $res[1].' City ';
//              echo $res[7].' KM ';
//              echo $res[11].' Mi ';
//              echo $res[8].' lat ';
//              echo $res[10].'lng<br>';
//          }

            return $response;
    }

    public function showAdStats(Request $request){

        $id = Route::current()->getParameter('id');
        $ad = Ad::where('id',$id)->first();
        $array_maanden = array('01' => 'jan', '02' => 'feb', '03' => 'maa', '04' => 'apr', '05' => 'mei','06' => 'jun','07' => 'jul','08' => 'aug','09' => 'sep','10' => 'okt','11' => 'nov','12' => 'dec');
        //$year = "2016";
        echo($request['month']);
        $month= '03';
       //$day= "23";
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
       
     
        
        
        //monds
        $list=array();
        $month = 03;
        $year = 2016;

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
		$dt = Carbon::parse('2016-03-23');
		$week_number = $dt->weekOfYear;
		$year = $dt->year;
		$dagen_week=array();
		for($day=1; $day<=7; $day++)
		{
		   $dagen_week[]= date('d-m-Y', strtotime($year."W".$week_number.$day));
		}

		
        return View::make('/reclameprofiel', compact('id','ad','allClicks','dagen_week','array_maanden','month','list','clickCount','janClicks','febClicks','maaClicks','aprClicks','meiClicks','junClicks','julClicks','augClicks','sepClicks','oktClicks','novClicks','decClicks'));
    }
}
