<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidadoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario está autenticado y no validado
        if (auth()->check() && (Auth::user())->validado == 0) {
            // Cierra la sesión del usuario
            Auth::guard('web')->logout();

            // Invalida la sesión actual
            $request->session()->invalidate();

            // Regenera el token de la sesión
            $request->session()->regenerateToken();

            return redirect('login')->with('error', 'Tu cuenta esta invalidada');
        }
        // Continúa con la solicitud normalmente si el usuario está validado
        return $next($request);
    }
}
