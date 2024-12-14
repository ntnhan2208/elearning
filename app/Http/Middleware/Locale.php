<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;

class Locale
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
        $lang = Language::active()->default()->first();
        $language = \Session::get('website_language', $lang->slug);
        config(['app.locale' => $language]);
        return $next($request);
    }
}
