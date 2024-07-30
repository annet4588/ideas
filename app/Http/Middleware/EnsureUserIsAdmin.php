<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log::info('before code execution');
        // $response = $next($request);
        // Log::info('after code execution');
        //Check if the user is an admin
        if(!auth()->user()->is_admin){
           abort(403); #403 -Forbidden
        }
        return $next($request);
    }
}
