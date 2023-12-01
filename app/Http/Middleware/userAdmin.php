<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class userAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Verificar si el usuario está autenticado
         if (Auth::check()) {
            // Obtener el rol del usuario autenticado
            $rol = Auth::user()->rol;

            // Verificar si el usuario pertenece al rol de dirección

                if ($rol['id'] == 2) {
                    return $next($request);
                }

                return redirect('/');
        }
    }
}
