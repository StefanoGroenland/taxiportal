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
        return $next($request)->header('Access-Control-Allow-Origin', '*');
    }
}
