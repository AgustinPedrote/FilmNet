<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audiovisual;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

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
        $pendientes = auth()->user()->usuariosPendientes;

        return view('pendientes.index', compact('pendientes'));
    }

    public function misAmigos()
    {
        // Obtén los audivisuales de la lista del usuario logado
        $amigos = auth()->user()->users;

        return view('amigos.index', compact('amigos'));
    }

    public function insertPendiente(Audiovisual $audiovisual)
    {

       $user =  User::find(auth()->user()->id);
        $user->usuariosPendientes()->attach($audiovisual);
        // Puedes redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('status', 'Audiovisual añadido a la lista de pendientes con éxito');
    }

    public function quitarPendiente(Audiovisual $audiovisual)
    {
        $user = User::find(auth()->user()->id);
        $pendientes = $user->usuariosPendientes();
        $pendientes->detach($audiovisual->id);

        // Puedes redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('status', 'Audiovisual eliminado de la lista de pendientes con éxito');
    }
}
