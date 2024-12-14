<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Google2FAAuthenticator;

class Google2fa
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
        $authenticator = app(Google2FAAuthenticator::class)->boot($request);
        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }
        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}
