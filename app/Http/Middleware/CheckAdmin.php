<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('web')->check() && auth('web')->user()->user_type == 'admin')
            return $next($request);
        else {
            auth('web')->logout();
            return redirect()->route('filament.admin.auth.login')->with('error', __('message.Unauthorized'));
        }
    }
}
