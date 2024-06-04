<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isset($request->user()->role))
        {
            if ($request->user()->role === "main_admin")
            //if ($request->user()->role === "admin")
            {
                return $next($request);
            }else
            {
                return response('Unauthorized.', Response::HTTP_UNAUTHORIZED);
            }
        }else
        {
            return response('Unauthorized.', Response::HTTP_UNAUTHORIZED);
        }
    }
}
