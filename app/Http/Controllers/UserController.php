<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function misVotaciones()
    {
        // Obtén las votaciones del usuario logado
        $votaciones = auth()->user()->votaciones;

        return view('votaciones.index', compact('votaciones'));
    }


    public function misCriticas()
    {
        // Obtén las criticas del usuario logado
        $criticas = auth()->user()->criticas;

        return view('criticas.miscriticas', compact('criticas'));
    }

    public function pendientes()
    {
        // Obtén los audivisuales pendientes de ver del usuario logado
        $pendientes = auth()->user()->pendientes;

        return view('pendientes.index', compact('pendientes'));
    }

    public function misAmigos()
    {
        // Obtén los audivisuales de la lista del usuario logado
        $amigos = auth()->user()->users;

        return view('amigos.index', compact('amigos'));
    }
}
