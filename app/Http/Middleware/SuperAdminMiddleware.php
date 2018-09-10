<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

use Session;
class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $superAdminId = Session::get('superAdminId');
        if($superAdminId == null){
            Redirect::to('/super/')->send();
        }

        return $next($request);
    }
}
