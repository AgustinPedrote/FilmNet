<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audiovisual;
use App\Models\Critica;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Votacion;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $premio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $premio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $premio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $premio)
    {
        //
    }

    public function misVotaciones()
    {
        // Votaciones del usuario logado
        $votaciones = Votacion::where('user_id', auth()->user()->id)->paginate(10);

        // Array asociativo de nombres de puntuaciones
        $puntuacionesNombres = [
            1 => 'Muy mala',
            2 => 'Mala',
            3 => 'Floja',
            4 => 'Regular',
            5 => 'Pasable',
            6 => 'Interesante',
            7 => 'Buena',
            8 => 'Notable',
            9 => 'Muy buena',
            10 => 'Excelente',
        ];

        return view('votaciones.index', compact('votaciones', 'puntuacionesNombres'));
    }

    public function misCriticas()
    {
        // Críticas del usuario logado paginadas
        $criticas = Critica::where('user_id', auth()->user()->id)->paginate(4);

        return view('criticas.miscriticas', compact('criticas'));
    }

    public function seguimientos()
    {
        // Audiovisuales en seguimiento paginados.
        $seguimientos = auth()->user()->usuariosSeguimientos;

        return view('seguimientos.index', compact('seguimientos'));
    }

    public function misAmigos()
    {
        // Audivisuales de la lista del usuario logado
        $amigos = auth()->user()->users;

        return view('amigos.index', compact('amigos'));
    }

    public function insertSeguimiento(Audiovisual $audiovisual)
    {
        $user =  User::find(auth()->user()->id);
        $user->usuariosSeguimientos()->attach($audiovisual);

        return redirect()->back()->with('status', 'Audiovisual añadido a la lista de seguimientos con éxito');
    }

    public function quitarSeguimiento(Audiovisual $audiovisual)
    {
        $user = User::find(auth()->user()->id);
        $user->usuariosSeguimientos()->detach($audiovisual->id);

        // Puedes redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('status', 'Audiovisual eliminado de la lista de seguimientos con éxito');
    }

    public function adminIndex()
    {
        return view('admin.index');
    }
}
