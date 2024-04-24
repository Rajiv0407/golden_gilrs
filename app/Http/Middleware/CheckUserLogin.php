<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */


class checkUserLogin extends Middleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
           return $next($request);
          
        }else{
             
            return redirect('/');
        }
      
    }
}
