<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfUserIsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // if the logged user isn't one manager redirect to home
        if (auth()->user()->manager == null) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
