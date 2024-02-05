<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Critica;
use App\Models\Rol;
use App\Models\Votacion;

class UserController extends Controller
{
    // Mostrar la lista paginada de usuarios en el panel de administración (Admin)
    public function index()
    {
        $users = User::orderBy('name')->paginate(4);
        $roles = Rol::all();

        return view('admin.users.index', ['users' => $users, 'roles' => $roles]);
    }

    // Vista del panel de administración (Admin)
    public function adminIndex()
    {
        return view('admin.index');
    }

    public function create()
    {
        //
    }

    public function store(StoreUserRequest $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    // Actualizar el rol de un usuario en la base de datos (Admin)
    public function update(Request $request, User $user)
    {
        $user->update([
            'rol_id' => $request->input('rol_id'),
        ]);

        return redirect()->route('admin.users.index', $user->id)->with('success', 'El rol del usuario ha sido actualizado con éxito.');
    }

    // Eliminar un usuario de la base de datos (Admin)
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'El usuario ha sido eliminado con éxito.');
    }

    // Mostrar las votaciones del usuario logueado
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

    // Mostrar las críticas del usuario logueado
    public function misCriticas()
    {
        $criticas = Critica::where('user_id', auth()->user()->id)->paginate(4);

        return view('criticas.miscriticas', compact(
            'criticas'
        ));
    }

    // Mostrar los seguidores del usuario logueado
    public function seguidores()
    {
        $seguidores = auth()->user()->seguidores;

        return view('amigos.usuariosSeguidores', compact(
            'seguidores'
        ));
    }

    // Mostrar los usuarios seguidos por el usuario logueado
    public function seguidos()
    {
        $amigos = auth()->user()->users;
        $usuarios = User::all();

        return view('amigos.usuariosSeguidos', compact(
            'amigos',
            'usuarios'
        ));
    }

    // Buscar amigos (usuarios seguidos) de forma asíncrona
    public function buscarAmigo(Request $request)
    {
        $query = $request->input('query');

        $resultados = User::where('name', 'ilike', '%' . $query . '%')->get();
        return response()->json(['amigos' => $resultados]);
    }

    // Seguir a un amigo (usuario seguido)
    public function seguirAmigo(Request $request)
    {
        $usuario = User::find(auth()->user()->id);
        $amigoId = $request->amigo;

        // Verificar si el usuario intenta seguirse a sí mismo
        if ($amigoId == $usuario->id) {
            return redirect()->back()->with('error', 'No puedes seguirte a ti mismo.');
        }

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

    // Dejar de seguir a un amigo (usuario seguido)
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

    // Mostrar la lista de audiovisuales en seguimiento del usuario logueado
    public function seguimientos()
    {
        $seguimientos = auth()->user()->usuariosSeguimientos->reverse();

        return view('seguimientos.index', compact('seguimientos'));
    }

    // Alternar el seguimiento de un audiovisual por el usuario logueado de forma asíncrona
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

    // Validar o invalidar a un usuario en el modo administrador (Admin)
    public function validar(User $user)
    {
        $user->validado = !$user->validado;
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuario validado/invalidado correctamente');
    }

    // Ver críticas de un usuario específico en el modo administrador (Admin)
    public function verCriticas(User $user)
    {
        // Críticas del usuario logado paginadas
        $criticas = Critica::where('user_id', $user->id)->paginate(4);

        return view('admin.users.miscriticas', compact(
            'criticas',
            'user'
        ));
    }

    // Ver críticas de un usuario específico
    public function usuarioCriticas(User $usuario)
    {
        $criticas = $usuario->criticas;

        return view('amigos.usuarioCriticas', compact('usuario', 'criticas'));
    }

    // Ver votaciones de un usuario específico
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

    // Eliminar una crítica de un usuario específico como administrador (Admin)
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
