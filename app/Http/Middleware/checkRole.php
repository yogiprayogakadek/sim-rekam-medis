<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        foreach($role as $r) {
            if($request->user()->hasRole($r)) {
                return $next($request);
            }
        }

        return response()->view('error.forbidden', [], 403);
        // abort(403);
    }
}
