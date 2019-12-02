<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkUser
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
        if (Auth::check()) {
            $user = Auth::User();
            if ($user->id == $id) {
                return $next($request);
            } else {
                return redirect()->route('client.profile.edit', $id);
            }
        } else {
            return redirect()->route('getLogin');
        }
    }
}
