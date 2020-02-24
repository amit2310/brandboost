<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }

    public function login()
    {
        Session::put('url.intended',URL::previous());
        return view('login');
    }
    public function loginPost()
    {
        if ($this->auth->attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
            return Redirect::to(Session::get('url.intended'));
        }
        return back();
    }
    
}
