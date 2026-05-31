<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackTrafficMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Do not track admin requests, api requests, or error/fallback requests
        if ($response->getStatusCode() === 200 && !$request->is('admin*') && !$request->is('api*') && !$request->is('_debugbar*')) {
            try {
                DB::table('visitor_logs')->insert([
                    'ip_address' => substr($request->ip(), 0, 45),
                    'user_agent' => substr($request->userAgent(), 0, 255),
                    'url'        => substr($request->getRequestUri(), 0, 255),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Fail silently so a database issue doesn't crash the public site
                logger('TrackTrafficMiddleware error: ' . $e->getMessage());
            }
        }

        return $response;
    }
}
