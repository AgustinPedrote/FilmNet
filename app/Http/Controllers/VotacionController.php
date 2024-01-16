<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVotacionRequest;
use App\Http\Requests\UpdateVotacionRequest;
use App\Models\Votacion;

class VotacionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    // Almacenar la votación de un audiovisual por un usuario logueado
    public function store(StoreVotacionRequest $request)
    {
        // Obtener el ID del usuario autenticado
        $user = auth()->user()->id;

        // Obtener el ID del audiovisual y el voto del formulario de solicitud
        $audiovisualId = $request->id;
        $voto = $request->voto;


        // Verificar si se seleccionó la opción para eliminar
        if ($voto === null) {
            // Eliminar la votación correspondiente
            Votacion::where('audiovisual_id', $audiovisualId)
                ->where('user_id', $user)
                ->delete();

            // Redireccionar de nuevo a la página anterior
            return response()->json('Voto nulo');
        }

        // Insertar o actualizar voto
        Votacion::updateOrInsert(
            ['audiovisual_id' => $audiovisualId, 'user_id' => $user],
            ['voto' => $voto]
        );

        // Redireccionar de nuevo a la página anterior
        return response()->json('Voto guardado');
    }

    // Mostrar las votaciones para un audiovisual específico
    public function show(StoreVotacionRequest $request)
    {
        // Obtener el ID del audiovisual desde la solicitud
        $audiovisualId = $request->id;

        // Buscar las votaciones para el audiovisual
        $search = Votacion::where('audiovisual_id', $audiovisualId)->get();

        // Formato JSON
        return response()->json($search);
    }

    public function edit(Votacion $votacion)
    {
        //
    }

    public function update(UpdateVotacionRequest $request, Votacion $votacion)
    {
        //
    }

    public function destroy(Votacion $votacion)
    {
        //
    }
}
