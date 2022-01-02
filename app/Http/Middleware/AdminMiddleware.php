<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use Lang;

class AdminMiddleware
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
        return auth('api')->user()?->is_admin === true ? $next($request) : JsonResponse::response(errors: [Lang::get('auth.unAuthorized')], statusCode: 403);
    }
}
