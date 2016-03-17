<?php

namespace App\Http\Middleware;

use Closure;

class AddHeaders
{
    /**
     * The URIs that should be excluded from Access-Controll-Allow-Origin.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next){
        $response = $next($request);
        $response->header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        $response->header('Access-Control-Allow-Origin' , '*');

        return $response;
    }
}
