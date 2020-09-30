<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorization
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
        if($request->header('api-key') === env('API_KEY'))
            return $next($request);

        return json('error', ['Not Authorized'],[''], 401);
    }
}
