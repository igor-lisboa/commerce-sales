<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Authenticator
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
        // se n esta logado entao redireciona p login
        if (!Auth::check()) {
            return redirect()->route('login')->withInput(['redirect' => URL::full()]);
        }

        return $next($request);
    }
}
