<?php

namespace App\Http\Middleware;

use Closure;

class Authorization
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
        $loggedUserId = getLoggedUserID();
        if(!$loggedUserId){
            return redirect()->action('Admin\Login@index');
        }
        
        return $next($request);
    }
}
