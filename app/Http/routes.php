<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', array('as' => 'home', 'uses' => 'UserController@showIndex'));
Route::get('/profiel', array('as' => 'profiel', 'uses' => 'UserController@showProfile'));
Route::get('/profielwijzigen', array('as' => 'profielwijzigen', 'uses' => 'UserController@showProfileEdit'));
Route::get('/chauffeurs', array('as' => 'chauffeurs', 'uses' => 'UserController@showDrivers'));
Route::get('/chauffeurwijzigen', array('as' => 'chauffeurwijzigen', 'uses' => 'UserController@showDriversEdit'));
Route::get('/chauffeurtoevoegen', array('as' => 'chauffeurtoevoegen', 'uses' => 'UserController@showDriversAdd'));
Route::get('/taxilocatie', array('as' => 'taxilocatie', 'uses' => 'TaxiController@showTaxiLocation'));
Route::get('/taxioverzicht', array('as' => 'taxioverzicht', 'uses' => 'TaxiController@showTaxiOverview'));
Route::get('/taxiwijzigen', array('as' => 'taxiwijzigen', 'uses' => 'TaxiController@showTaxiEdit'));
Route::get('/taxitoevoegen', array('as' => 'taxitoevoegen', 'uses' => 'TaxiController@showTaxiAdd'));
Route::get('/ritten', array('as' => 'ritten', 'uses' => 'RouteController@showRoutes'));
Route::get('/rittoevoegen', array('as' => 'rittoevoegen', 'uses' => 'RouteController@showRoutesAdd'));

Route::get('/ritwijzigen', array('as' => 'ritwijzigen', 'uses' => 'RouteController@showRoutesEdit'));
Route::get('/opmerkingen', array('as' => 'opmerkingen', 'uses' => 'CommentController@showComment'));
Route::get('/opmerkingwijzigen', array('as' => 'opmerkingwijzigen', 'uses' => 'CommentController@showCommentEdit'));
Route::get('/tablets', array('as' => 'tablets', 'uses' => 'UserController@showTablet'));
Route::get('/tabletwijzigen', array('as' => 'tabletwijzigen', 'uses' => 'UserController@showTabletEdit'));
Route::get('/medewerkers', array('as' => 'medewerkers', 'uses' => 'UserController@showAdmin'));
Route::get('/medewerkerwijzigen', array('as' => 'medewerkerwijzigen', 'uses' => 'UserController@showAdminEdit'));
Route::get('/medewerkertoevoegen', array('as' => 'medewerkertoevoegen', 'uses' => 'UserController@showAdminAdd'));
Route::get('/reclames', array('as' => 'reclames', 'uses' => 'AdController@showAds'));
Route::get('/reclamewijzigen', array('as' => 'reclamewijzigen', 'uses' => 'AdController@showAdsEdit'));
Route::get('/reclametoevoegen', array('as' => 'reclametoevoegen', 'uses' => 'AdController@showAdsAdd'));

//API v1.0 routes
Route::get('/api/v1/advertisements/{location}/{key}', 'ApiOneController@adsPerLocation');