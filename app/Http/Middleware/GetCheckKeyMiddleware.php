<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GetCheckKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validApiKey = config('auth.secret_key');

        $providedApiKey = $request->query('key');

        if (!$providedApiKey) {
            return response()->json([
                'error' => 'API key is required',
                'message' => 'Please provide API key in the "key" query parameter'
            ], 401);
        }

        if ($providedApiKey !== $validApiKey) {
            return response()->json([
                'error' => 'Invalid API key',
                'message' => 'The provided API key is invalid'
            ], 401);
        }

        return $next($request);
    }
}
