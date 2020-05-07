<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyJWTToken
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
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json('you are must login');
        }

        $user = User::where('remember_token', $token)->get()->first();
        if ($user) {
            Auth::setUser($user);
        } else {
            return response()->json('invalid token');
        }

        return $next($request);
    }
}
