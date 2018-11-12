<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;

class ReferrerMiddleware
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
        $referrerId = Session::get('referrerId');
        if($referrerId == null){
            Redirect::to('/referrer/')->send();
        }

        return $next($request);
    }
}
