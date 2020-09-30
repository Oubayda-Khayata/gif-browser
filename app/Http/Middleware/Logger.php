<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logger
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
        $user = Auth::user();
        if ($user) {
            Log::create([
                'user_id' => $user->id,
                'datetime' => Carbon::now()->getTimestamp()
            ]);
        }
        return $next($request);
    }
}
