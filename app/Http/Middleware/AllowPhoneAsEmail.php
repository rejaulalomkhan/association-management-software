<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowPhoneAsEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If this is a login POST request and email contains a phone number
        if ($request->isMethod('post') &&
            $request->is('login') &&
            $request->has('email') &&
            preg_match('/^[0-9+\-\s()]+$/', $request->input('email'))) {

            // Add fake email domain to pass Laravel's email validation
            $phone = $request->input('email');
            $request->merge([
                'email' => $phone . '@phone.local',
            ]);
        }

        return $next($request);
    }
}
