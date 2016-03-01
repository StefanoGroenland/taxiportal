<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
use App\Taxi;
use App\Driver;

class TaxiController extends Controller
{
    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the taxi location view and passes a variable with it.
     */
    public function showTaxiLocation(){
        $taxis = Taxi::with('driver')->get();
		return View::make('/taxilocatie', compact('taxis'));
	}

    /**
     * @author Stefano Groenland
     * @return mixed
     *
     * Makes the taxi overview view and passes 2 variables with it.
     */
    public function showTaxiOverview(){
        $taxis = Taxi::all();
        $drivers = Driver::with('user')->get();
		return View::make('/taxioverzicht', compact('taxis', 'drivers'));
	}

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     *  TODO : fill in func description
     */
    public function showTaxiEdit(){
		return View::make('/taxiwijzigen');
	}

    /**
     * @author Richard Perdaan
     * @return mixed
     *
     *  TODO : fill in func description
     */
    public function showTaxiAdd(){
		return View::make('/taxitoevoegen');
	}
}
