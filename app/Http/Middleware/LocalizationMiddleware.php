<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Localization as locale;
use Lang;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Content-Language');
        if (!$locale) {
            return response()->json(['message' => Lang::get('auth.setHeaderLang')], 200);
        }
        locale::setlocale($locale);
        return $next($request);
    }
}
