<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next) {
        // I'm using the api guard
        
        if(Auth::check()){
            
        $role = strtolower( request()->user()->role );
        
        $allowed_roles = array_slice(func_get_args(), 2);
       
        if( in_array($role, $allowed_roles) ) {
             
            return $next($request);
        }
     
            return redirect('admin/dashboard')->with('error', 'No Access!');
        }
        else{
           
            return redirect('/login')->with('error', 'No Access!');
        }
      
        //throw new AuthenticationException();
    }
}
