<?php

namespace App\Http\Middleware;
session_start();
use Closure;
use Session;
use Illuminate\Support\Facades\Redirect;

class LoginMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $usrInfo = Session::get('usrInfo');
        if ($usrInfo == NULL) {
            return Redirect::to('/login');
        }
        return $next($request);
//        if($usrInfo){
//            return $next($request);
//        }else{
//            return Redirect::to('/login');
//        }
    }

}
