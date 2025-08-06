<?php

namespace App\Http\Middleware;

use App\helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class ApiGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            if (JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Already authenticated'], 403);
            }
        } catch (\Exception $e) {
            //
        }

        return $next($request);
    }
}
