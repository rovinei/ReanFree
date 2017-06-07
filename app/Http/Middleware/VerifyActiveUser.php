<?php

namespace App\Http\Middleware;

use Closure;
use URL;
use Illuminate\Support\Facades\Auth;

class VerifyActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guard)
    {
        if(Auth::check() && Auth::user()->is_active !=1){
            Auth::logout();
            return redirect(url(URL::previous()))
                    ->withErrors(['user_deactivated' => 'sorry, this user account is deactivated']);
        }

        return $next($request);
    }
}
