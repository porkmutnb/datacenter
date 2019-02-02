<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\User;

use Illuminate\Support\Facades\Redirect;

class UserAuthenticate
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
        if(Auth::User()) {
            return $next($request);
        }else{
            return Redirect::to('login');
        }
    }
}
