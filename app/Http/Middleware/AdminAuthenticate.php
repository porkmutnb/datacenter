<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\Admin;

use Illuminate\Support\Facades\Redirect;

class AdminAuthenticate
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
        if(Auth::guard('admin')->check()) {
            return $next($request);
        }else{
            return Redirect::to('admin/login');
        }
    }
}
