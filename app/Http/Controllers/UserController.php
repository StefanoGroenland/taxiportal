<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Route, View;
class UserController extends Controller
{	
    public function showIndex(){
		return View::make('/index');
	}
	public function showProfile(){
		return View::make('/profiel');
	}
	public function showProfileEdit(){
		return View::make('/profielwijzigen');
	}
	public function showDrivers(){
        $drivers = Driver::with('user','taxi')->get();
		return View::make('/chauffeurs', compact('drivers','taxis'));
	}
	public function showDriversEdit(){
		return View::make('/chauffeurwijzigen');
	}
	public function showDriversAdd(){
		return View::make('/chauffeurtoevoegen');
	}
	public function showTablet(){
		return View::make('/tablets');
	}
	public function showTabletEdit(){
		return View::make('/tabletwijzigen');
	}
	public function showAdmin(){
		return View::make('/medewerkers');
	}
	public function showAdminEdit(){
		return View::make('/medewerkerwijzigen');
	}
	public function showAdminAdd(){
		return View::make('/medewerkertoevoegen');
	}
}

