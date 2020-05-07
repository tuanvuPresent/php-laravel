<?php

namespace App\Http\Middleware;

use Closure;

class CheckTest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->test == null) {
            return response('Middleware Test');
        }
        return $next($request);
    }
}
