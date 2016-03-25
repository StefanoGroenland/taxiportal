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
    return View::make('auth/login');
});

//Routes where the user must be logged in.
Route::group(['middleware' => 'auth'], function () {

        Route::get('/home', array('as' => 'home', 'uses' => 'UserController@showIndex'));
        Route::get('/profiel', array('as' => 'profiel', 'uses' => 'UserController@showProfile'));
        Route::get('/profielwijzigen', array('as' => 'profielwijzigen', 'uses' => 'UserController@showProfileEdit'));
        Route::get('/opmerkingen', array('as' => 'opmerkingen', 'uses' => 'CommentController@showComment'));
        Route::put('/editProfile/{id}', 'UserController@editProfile');
        Route::put('/editPassword/{id}', 'UserController@editPassword');
        Route::put('/editProfilePhoto/{id}', 'UserController@editProfilePhoto');
        Route::get('/ritten', array('as' => 'ritten', 'uses' => 'RouteController@showRoutes'));

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



        Route::get('/ritten/openstaand', array('as' => 'rittenopenstaand', 'uses' => 'RouteController@showRoutesOpen'));
        Route::get('/toggleRoute/{id}/{redir}', array('as' => 'ritaccepteren', 'uses' => 'RouteController@toggleRoute'));

        Route::get('/opmerkingen/verwerkt', array('as' => 'opmerkingen-openstaand', 'uses' => 'CommentController@showCommentsApproved'));
        Route::get('/opmerkingwijzigen/{id}', array('as' => 'opmerkingwijzigen', 'uses' => 'CommentController@showCommentEdit'));
        Route::put('/editComment/{id}', 'CommentController@editComment');
        Route::get('/toggleComment/{id}/{redir}', 'CommentController@togglesStateComment');
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
        Route::get('/reclames/soort', array('as' => 'reclames', 'uses' => 'AdController@showAdsPanel'));
        Route::get('/reclames/{id}', array('as' => 'reclameprofiel', 'uses' => 'AdController@showAdStats'));
        Route::get('/reclamewijzigen/{id}/{type}', array('as' => 'reclamewijzigen', 'uses' => 'AdController@showAdsEdit'));
        Route::get('/reclametoevoegen/{type}', array('as' => 'reclametoevoegen', 'uses' => 'AdController@showAdsAdd'));
        Route::post('/addAd/{type}', 'AdController@addAd');
        Route::delete('/deleteAd/{id}', 'AdController@deleteAd');
        Route::put('/editAd/{id}/{type}', array('as' => 'editAd', 'uses' => 'AdController@editAd'));
        Route::get('/noodsignalen', array('as' => 'noodsignalen', 'uses' => 'EmergencyController@showSignals'));
        Route::get('/seenSignal/{id}', array('as' => 'signalChange', 'uses' => 'EmergencyController@seenSignal'));

    });
});

// Authentication routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');


//API v1.0 routes
Route::post('/api/v1/advertisements'                , 'ApiController@adsPerLocation');
Route::post('/api/v1/advertisements/type'           , 'ApiController@adsByType');
Route::post('/api/v1/advertisements/increaseclick'  , 'ApiController@increaseClickOfAd');
Route::post('/api/v1/driver'                        , 'ApiController@getDriverOffTablet');
Route::post('/api/v1/allroutes'                     , 'ApiController@getRoutes');
Route::post('/api/v1/routes'                        , 'ApiController@getRoutesForTaxi');
Route::post('/api/v1/newsfeed'                      , 'ApiController@getNewsfeeds');
Route::post('/api/v1/sos'                           , 'ApiController@sendSOS');
Route::post('/api/v1/tabletlogin'                   , 'ApiController@tabletLogin');
Route::post('/api/v1/postcomment'                   , 'ApiController@postComment');
Route::post('/api/v1/getcomments'                   , 'ApiController@getCommentsOffDriver');
Route::get('/api/v1/signalcheck'                    , 'ApiController@signalCheck');
Route::get('/api/v1/emergencies'                    , 'ApiController@getSOS');
Route::post('/api/v1/sendlocation'                  , 'ApiController@sendLocation');
Route::post('/api/v1/inshift'                       , 'ApiController@inShift');
Route::post('/api/v1/offshift'                      , 'ApiController@offShift');
Route::post('/api/v1/returnrequest'                 , 'ApiController@requestReturnRide');
Route::post('/api/v1/postbase'                      , 'ApiController@postBase');
Route::post('/api/v1/locations'                     , 'ApiController@getLocations');
Route::post('/api/v1/locations/bases'               , 'ApiController@getBaseLocations');
Route::post('/api/v1/shift/state'                   , 'ApiController@getShiftstate');
Route::post('/api/v1/geocode/locations'             , 'ApiController@getShiftstate');
Route::post('/api/v1/statistics/year'               , 'ApiController@statisticsDataYear');
Route::post('/api/v1/statistics/month'              , 'ApiController@statisticsDataMonth');
Route::post('/api/v1/statistics/week'               , 'ApiController@statisticsDataWeek');

