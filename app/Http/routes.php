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

        Route::get('/nieuws', array('as' => 'nieuws', 'uses' => 'NewspaperController@showNews'));
        Route::get('/nieuwstoevoegen', array('as' => 'nieuwstoevoegen', 'uses' => 'NewspaperController@showNewsAdd'));
        Route::get('/nieuwswijzigen/{id}', array('as' => 'nieuwswijzigen', 'uses' => 'NewspaperController@showNewsEdit'));
        Route::post('/addNews', 'NewspaperController@addNews');
        Route::put('/editNews/{id}', 'NewspaperController@editNews');
        Route::delete('/deleteNews/{id}', 'NewspaperController@deleteNews');


        Route::get('/taxilocatie', array('as' => 'taxilocatie', 'uses' => 'TaxiController@showTaxiLocation'));
        Route::get('/taxioverzicht', array('as' => 'taxioverzicht', 'uses' => 'TaxiController@showTaxiOverview'));
        Route::get('/taxiwijzigen/{id}', array('as' => 'taxiwijzigen', 'uses' => 'TaxiController@showTaxiEdit'));
        Route::get('/taxitoevoegen', array('as' => 'taxitoevoegen', 'uses' => 'TaxiController@showTaxiAdd'));
        Route::post('/addTaxi', 'TaxiController@addTaxi');
        Route::post('/editTaxi/{id}', 'TaxiController@editTaxi');
        Route::delete('/deleteTaxi/{id}', 'TaxiController@deleteTaxi');

        Route::get('/rittoevoegen', array('as' => 'rittoevoegen', 'uses' => 'RouteController@showRoutesAdd'));
        Route::get('/ritwijzigen/{id}', array('as' => 'ritwijzigen', 'uses' => 'RouteController@showRoutesEdit'));
        Route::post('/addRoute', 'RouteController@addRoute');
        Route::delete('/deleteRoute/{id}', 'RouteController@deleteRoute');
        Route::put('/editRoute/{id}', array('as' => 'editRoute', 'uses' => 'RouteController@editRoute'));
       
        Route::get('/opmerkingwijzigen/{id}', array('as' => 'opmerkingwijzigen', 'uses' => 'CommentController@showCommentEdit'));
        Route::put('/editComment/{id}', 'CommentController@editComment');
        Route::get('/toggleComment/{id}', 'CommentController@togglesStateComment');
        Route::delete('/deleteComment/{id}', 'CommentController@deleteComment');

        Route::get('/tablets', array('as' => 'tablets', 'uses' => 'UserController@showTablet'));
        Route::get('/tablettoevoegen', array('as' => 'tablettoevoegen', 'uses' => 'UserController@showTabletAdd'));
        Route::get('/tabletwijzigen/{id}', array('as' => 'tabletwijzigen', 'uses' => 'UserController@showTabletEdit'));
        Route::post('/addTablet', 'UserController@addTablet');
        Route::put('/editTablet/{id}', 'UserController@editTablet');
        Route::delete('/deleteTablet/{id}', 'UserController@deleteTablet');
        Route::get('/medewerkers', array('as' => 'medewerkers', 'uses' => 'UserController@showAdmin'));
        Route::get('/medewerkerwijzigen/{id}', array('as' => 'medewerkerwijzigen', 'uses' => 'UserController@showAdminEdit'));
        Route::get('/medewerkertoevoegen', array('as' => 'medewerkertoevoegen', 'uses' => 'UserController@showAdminAdd'));
        Route::post('/addAdmin', 'UserController@addAdmin');
        Route::put('/editAdmin/{id}', 'UserController@editAdmin');
        Route::delete('/deleteAdmin/{id}', 'UserController@deleteAdmin');
        Route::get('/reclames', array('as' => 'reclames', 'uses' => 'AdController@showAds'));
        Route::get('/reclamewijzigen/{id}', array('as' => 'reclamewijzigen', 'uses' => 'AdController@showAdsEdit'));
        Route::get('/reclametoevoegen', array('as' => 'reclametoevoegen', 'uses' => 'AdController@showAdsAdd'));
        Route::post('/addAd', 'AdController@addAd');
        Route::delete('/deleteAd/{id}', 'AdController@deleteAd');
        Route::put('/editAd/{id}', array('as' => 'editAd', 'uses' => 'AdController@editAd'));
        Route::get('/noodsignalen', array('as' => 'noodsignalen', 'uses' => 'EmergencyController@showSignals'));
        Route::get('/seenSignal/{id}', array('as' => 'signalChange', 'uses' => 'EmergencyController@seenSignal'));

    });
});

// Authentication routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//API v1.0 routes
Route::get('/api/v1/advertisements/{location}/{key}', 'ApiOneController@adsPerLocation');
Route::post('/api/v1/advertisements/increaseclick'  , 'ApiOneController@increaseClickOfAd');
Route::get('/api/v1/driver/{tablet}/{key}'          , 'ApiOneController@getDriverOffTablet');
Route::get('/api/v1/routes/{key}'                   , 'ApiOneController@getRoutes');
Route::get('/api/v1/routes/{taxiId}/{key}'          , 'ApiOneController@getRoutesForTaxi');
Route::get('/api/v1/newsfeed/{key}'                 , 'ApiOneController@getNewsfeeds');
Route::post('/api/v1/sos'                           , 'ApiOneController@sendSOS');
Route::post('/api/v1/tabletlogin'                   , 'ApiOneController@tabletLogin');
Route::post('/api/v1/postcomment'                   , 'ApiOneController@postComment');
Route::post('/api/v1/getcomment'                    , 'ApiOneController@getCommentsOffDriver');
Route::get('/api/v1/signalcheck'                    , 'ApiOneController@signalCheck');
Route::get('/api/v1/emergencies'                    , 'ApiOneController@getSOS');
Route::post('/api/v1/sendlocation'                  , 'ApiOneController@sendLocation');
Route::post('/api/v1/toggleshift'                   , 'ApiOneController@toggleShift');