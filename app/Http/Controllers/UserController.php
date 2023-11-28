<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audiovisual;
use App\Models\Critica;
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
        // Obtén las críticas del usuario logado paginadas
        $criticas = Critica::where('user_id', auth()->user()->id)->paginate(4);

        return view('criticas.miscriticas', compact('criticas'));
    }

    public function seguimientos()
    {
        // Obtén los audivisuales en seguimiento.
        $seguimientos = auth()->user()->usuariosSeguimientos;

        return view('seguimientos.index', compact('seguimientos'));
    }

    public function misAmigos()
    {
        // Obtén los audivisuales de la lista del usuario logado
        $amigos = auth()->user()->users;

        return view('amigos.index', compact('amigos'));
    }

    public function insertSeguimiento(Audiovisual $audiovisual)
    {

        $user =  User::find(auth()->user()->id);
        $user->usuariosSeguimientos()->attach($audiovisual);
        // Puedes redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('status', 'Audiovisual añadido a la lista de seguimientos con éxito');
    }

    public function quitarSeguimiento(Audiovisual $audiovisual)
    {
        $user = User::find(auth()->user()->id);
        $seguimientos = $user->usuariosSeguimientos();
        $seguimientos->detach($audiovisual->id);

        // Puedes redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('status', 'Audiovisual eliminado de la lista de seguimientos con éxito');
    }
}
