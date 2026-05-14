<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPendingStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has pending status
        if (Auth::check() && Auth::user()->status === 'pending') {
            // Store phone before logout
            $phone = Auth::user()->phone;
            
            // Logout the user
            Auth::logout();
            
            // Redirect to pending status page with phone
            return redirect()->route('pending-status', ['phone' => $phone]);
        }

        return $next($request);
    }
}
