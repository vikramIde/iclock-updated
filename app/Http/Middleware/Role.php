<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
        public function handle($request, Closure $next, $role){
           
            if ($request->user()->role != $role){

                    if($role=="collector" || $role=="admin" )
                    return Redirect::to('/');  
                    if($role=="director" || $role=="admin" )
                    return Redirect::to('/');  
                    if($role=="admin1" || $role=="admin" )
                    return Redirect::to('/');
                    if($role=="admin2" || $role=="admin" )
                    return Redirect::to('/');
                    if($role=="sales" || $role=="admin" )
                     return Redirect::to('/');


            }

            return $next($request);
        }

}
