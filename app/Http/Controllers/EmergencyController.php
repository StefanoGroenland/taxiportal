<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Emergency;

class EmergencyController extends Controller
{
    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the emergency records view.
     */
    public function showSignals(){
        $emergencies = Emergency::with('taxi')->where('seen','=',0)->get();
        $emergenciesSeen = Emergency::with('taxi')->where('seen', '!=',0)->get();
        return View::make('/noodsignalen', compact('emergencies','emergenciesSeen'));
    }

    /**
     * @author Stefano Groenland
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Changes the 'seen' column's value from the database to the opposite.
     */
    public function seenSignal(){
        $id = Route::current()->getParameter('id');
        $msg = Emergency::where('id',$id)->first();
        if(!$msg->seen > 0){
            $msg->where('id',$id)->update(['seen' => 1]);
        }else{
            $msg->where('id',$id)->update(['seen' => 0]);
        }
        session()->flash('alert-success', 'Melding gezien status aangepast.');
        return redirect('/noodsignalen');
    }
}
