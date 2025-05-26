<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si la solicitud no es segura (no usa HTTPS)
        if (!$request->secure()) {
            // Redirige a la misma URL pero usando HTTPS
            return redirect()->secure($request->getRequestUri());
        }

        // Continúa con la solicitud si ya es HTTPS
        return $next($request);
    }
}
