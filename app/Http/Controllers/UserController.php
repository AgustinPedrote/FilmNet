<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audiovisual;
use App\Models\Critica;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

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
