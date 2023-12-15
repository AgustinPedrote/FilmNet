<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audiovisual;
use App\Models\Critica;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Votacion;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    // Usuarios en el panel de administración
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.users.index', ['users' => $users]);
    }

    // Index en el panel de administración
    public function adminIndex()
    {
        return view('admin.index');
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'El usuario ha sido eliminado con éxito.');
    }

    // Las votaciones del usuario logueado
    public function misVotaciones()
    {
        // Votaciones del usuario logado y paginado
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

        return view('votaciones.index', compact(
            'votaciones',
            'puntuacionesNombres'
        ));
    }

    // Las críticas del usuario logueado
    public function misCriticas()
    {
        // Críticas del usuario logado paginadas
        $criticas = Critica::where('user_id', auth()->user()->id)->paginate(4);

        return view('criticas.miscriticas', compact(
            'criticas'
        ));
    }

    // Amigos del usuario logueado
    public function misAmigos()
    {
        $amigos = auth()->user()->users;

        return view('amigos.index', compact(
            'amigos'
        ));
    }

    // Mi lista de audiovisuales en seguimiento (paginados)
    public function seguimientos()
    {
        // Audiovisuales en seguimiento sin paginar
        $seguimientos = auth()->user()->usuariosSeguimientos;

        // Configura la paginación
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $seguimientos->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $seguimientosPaginados = new LengthAwarePaginator($currentItems, $seguimientos->count(), $perPage);

        // Establece la ruta correcta para los enlaces de paginación
        $seguimientosPaginados->withPath(route('seguimientos.index'));

        return view('seguimientos.index', compact('seguimientosPaginados'));
    }

    // Insertar audiovisual en mi lista de seguimientos
    public function insertSeguimiento(Audiovisual $audiovisual)
    {
        $user =  User::find(auth()->user()->id);
        $user->usuariosSeguimientos()->attach($audiovisual);

        return redirect()->back()->with('status', 'Audiovisual añadido a la lista de seguimientos con éxito');
    }

    // Eliminar audiovisual en mi lista de seguimientos
    public function quitarSeguimiento(Audiovisual $audiovisual)
    {
        $user = User::find(auth()->user()->id);
        $user->usuariosSeguimientos()->detach($audiovisual->id);

        // Puedes redirigir o mostrar un mensaje de éxito
        return redirect()->back()->with('status', 'Audiovisual eliminado de la lista de seguimientos con éxito');
    }

    public function validar(User $user)
    {
        $user->validado = !$user->validado;
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario validado/invalidado correctamente');
    }
}
