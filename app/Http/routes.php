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

//Routes where the user must be logged in.
Route::group(['middleware' => 'auth'], function () {

        Route::get('/home', array('as' => 'home', 'uses' => 'UserController@showIndex'));
        Route::get('/profiel', array('as' => 'profiel', 'uses' => 'UserController@showProfile'));
        Route::get('/profielwijzigen', array('as' => 'profielwijzigen', 'uses' => 'UserController@showProfileEdit'));
        Route::get('/ritten', array('as' => 'ritten', 'uses' => 'RouteController@showRoutes'));
        Route::get('/opmerkingen', array('as' => 'opmerkingen', 'uses' => 'CommentController@showComment'));

    //Routes alleen voor admins.
    Route::group(['middleware' => 'isAdmin'], function () {
        
        Route::get('/chauffeurs', array('as' => 'chauffeurs', 'uses' => 'UserController@showDrivers'));
        Route::get('/chauffeurwijzigen/{id}', array('as' => 'chauffeurwijzigen', 'uses' => 'UserController@showDriversEdit'));
        Route::get('/chauffeurtoevoegen', array('as' => 'chauffeurtoevoegen', 'uses' => 'UserController@showDriversAdd'));
        Route::post('/addDriver', 'UserController@addDriver');
        Route::delete('/deleteDriver/{id}', 'UserController@deleteDriver');
        Route::put('/editDriver/{id}', array('as' => 'editDriver', 'uses' => 'UserController@editDriver'));       
        
        Route::get('/taxilocatie', array('as' => 'taxilocatie', 'uses' => 'TaxiController@showTaxiLocation'));
        Route::get('/taxioverzicht', array('as' => 'taxioverzicht', 'uses' => 'TaxiController@showTaxiOverview'));
        Route::get('/taxiwijzigen', array('as' => 'taxiwijzigen', 'uses' => 'TaxiController@showTaxiEdit'));
        Route::get('/taxitoevoegen', array('as' => 'taxitoevoegen', 'uses' => 'TaxiController@showTaxiAdd'));

        Route::get('/rittoevoegen', array('as' => 'rittoevoegen', 'uses' => 'RouteController@showRoutesAdd'));

        Route::get('/ritwijzigen', array('as' => 'ritwijzigen', 'uses' => 'RouteController@showRoutesEdit'));
        Route::get('/opmerkingwijzigen', array('as' => 'opmerkingwijzigen', 'uses' => 'CommentController@showCommentEdit'));
        Route::get('/tablets', array('as' => 'tablets', 'uses' => 'UserController@showTablet'));
        Route::get('/tabletwijzigen', array('as' => 'tabletwijzigen', 'uses' => 'UserController@showTabletEdit'));
        Route::get('/medewerkers', array('as' => 'medewerkers', 'uses' => 'UserController@showAdmin'));
        Route::get('/medewerkerwijzigen', array('as' => 'medewerkerwijzigen', 'uses' => 'UserController@showAdminEdit'));
        Route::get('/medewerkertoevoegen', array('as' => 'medewerkertoevoegen', 'uses' => 'UserController@showAdminAdd'));
        Route::get('/reclames', array('as' => 'reclames', 'uses' => 'AdController@showAds'));
        Route::get('/reclamewijzigen/{id}', array('as' => 'reclamewijzigen', 'uses' => 'AdController@showAdsEdit'));
        Route::get('/reclametoevoegen', array('as' => 'reclametoevoegen', 'uses' => 'AdController@showAdsAdd'));
        Route::post('/addAd', 'AdController@addAd');
        Route::delete('/deleteAd/{id}', 'AdController@deleteAd');
        Route::put('/editAd/{id}', array('as' => 'editAd', 'uses' => 'AdController@editAd'));
    });
});

// Authentication routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//API v1.0 routes
Route::get('/api/v1/advertisements/{location}/{key}', 'ApiOneController@adsPerLocation');
Route::post('/api/v1/advertisements/increaseclick', 'ApiOneController@increaseClickOfAd');
Route::get('/api/v1/driver/{tablet}/{key}', 'ApiOneController@getDriverOffTablet');
Route::get('/api/v1/routes/{key}', 'ApiOneController@getRoutes');
Route::get('/api/v1/routes/{taxiId}/{key}', 'ApiOneController@getRoutesForTaxi');