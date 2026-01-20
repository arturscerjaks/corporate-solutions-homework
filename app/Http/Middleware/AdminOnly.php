<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Deny if not admin for both WEB and API routes
     *
     * @param  Request  $request
     * @param  Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            // Return JSON if it's an API request
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Admins only.'], 403);
            }

            // Otherwise use web abort
            abort(403, 'Admins only.');
        }

        return $next($request);
    }
}
