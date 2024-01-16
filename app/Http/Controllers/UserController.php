<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriticaRequest;
use App\Models\User;
use App\Models\Audiovisual;
use App\Models\Critica;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Rol;
use App\Models\Votacion;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;


class UserController extends Controller
{
    // Usuarios en el panel de administración
    public function index()
    {
        $users = User::orderBy('name')->paginate(4);
        $roles = Rol::all();

        return view('admin.users.index', ['users' => $users, 'roles' => $roles]);
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
    public function update(Request $request, User $user)
    {
        $user->update([
            'rol_id' => $request->input('rol_id'),
        ]);

        // Puedes redirigir a la vista de detalles del usuario o a donde desees
        return redirect()->route('admin.users.index', $user->id)->with('success', 'El rol del usuario ha sido actualizado con éxito.');
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

    // Usuarios seguidores
    public function seguidores()
    {
        $seguidores = auth()->user()->seguidores;

        return view('amigos.usuariosSeguidores', compact(
            'seguidores'
        ));
    }

    // Usuarios seguidos
    public function seguidos()
    {
        $amigos = auth()->user()->users;
        $usuarios = User::all();

        return view('amigos.usuariosSeguidos', compact(
            'amigos',
            'usuarios'
        ));
    }

    public function buscarAmigo(Request $request)
    {
        $query = $request->input('query');

        $resultados = User::where('name', 'ilike', '%' . $query . '%')->get();
        return response()->json(['amigos' => $resultados]);
    }

    public function seguirAmigo(Request $request)
    {
        $usuario = User::find(auth()->user()->id);
        $amigoId = $request->amigo;

        // Verificar si el usuario ya sigue al amigo
        if ($usuario->users()->where('id', $amigoId)->exists()) {
            return redirect()->back()->with('error', 'Ya sigues a este amigo.');
        }

        // Verificar si el amigo con el ID proporcionado existe
        $amigo = User::find($amigoId);

        if (!$amigo) {
            return redirect()->back()->with('error', 'El usuario no existe.');
        }

        // Agregar la relación sin duplicados
        $usuario->users()->syncWithoutDetaching($amigoId);

        return redirect()->back()->with('success', 'Amigo seguido con éxito');
    }

    public function dejarDeSeguir(User $amigo)
    {
        $usuario = User::find(auth()->user()->id);

        // Verificar si el usuario sigue al amigo
        if ($usuario->users()->where('id', $amigo->id)->exists()) {
            $usuario->users()->detach($amigo->id);
            return redirect()->back()->with('success', 'Dejaste de seguir a ' . $amigo->name);
        }

        return redirect()->back()->with('error', 'No estás siguiendo a ' . $amigo->name);
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

    // Botón asíncrono de lista de seguimiento
    public function toggleSeguimiento(Request $request)
    {
        $audiovisualId = $request->input('audiovisual_id');
        $user = User::find(auth()->user()->id);

        if ($user->usuariosSeguimientos->contains('id', $audiovisualId)) {
            $user->usuariosSeguimientos()->detach($audiovisualId);
            return response()->json(['status' => 'removed', 'message' => 'Audiovisual eliminado de la lista de seguimientos con éxito']);
        } else {
            $user->usuariosSeguimientos()->attach($audiovisualId);
            return response()->json(['status' => 'added', 'message' => 'Audiovisual añadido a la lista de seguimientos con éxito']);
        }
    }

    // Validar usuarios en el modo Admin
    public function validar(User $user)
    {
        $user->validado = !$user->validado;
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario validado/invalidado correctamente');
    }

    // ver críticas como
    public function verCriticas(User $user)
    {

        // Críticas del usuario logado paginadas
        $criticas = Critica::where('user_id', $user->id)->paginate(4);

        return view('admin.users.miscriticas', compact(
            'criticas',
            'user'
        ));
    }

    // Críticas de amigos
    public function usuarioCriticas(User $usuario)
    {
        $criticas = $usuario->criticas;

        return view('amigos.usuarioCriticas', compact('usuario', 'criticas'));
    }

    // Votaciones de amigos
    public function usuarioVotaciones(User $usuario)
    {
        // Votaciones del usuario y paginado
        $votaciones = Votacion::where('user_id', $usuario->id)->paginate(10);

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

        return view('amigos.usuarioVotaciones', compact('votaciones', 'puntuacionesNombres', 'usuario'));
    }

    // Eliminar una crítica como administrador
    public function verCriticasDestroy($usuario_id, $audiovisual_id)
    {
        // Buscar la crítica pasandole el usuario y el audiovisual.
        Critica::where('audiovisual_id', $audiovisual_id)
            ->where('user_id', $usuario_id)
            ->delete();

        // Redireccionar de nuevo a la página anterior
        return redirect()->back()->with('success', 'Crítica eliminada con éxito');
    }
}
