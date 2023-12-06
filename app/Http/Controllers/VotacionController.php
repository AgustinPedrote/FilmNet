<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVotacionRequest;
use App\Http\Requests\UpdateVotacionRequest;
use App\Models\Audiovisual;
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

    // Votación del audiovisual por un usuario logueado
    public function store(StoreVotacionRequest $request)
    {
        // Obtener el ID del usuario autenticado
        $user = auth()->user()->id;

        // Obtener el ID del audiovisual y el voto del formulario de solicitud
        $audiovisualId = $request->audiovisual;
        $voto = $request->voto;

        // Verificar si se seleccionó la opción para eliminar
        if ($voto === null) {
            // Eliminar la votación correspondiente
            Votacion::where('audiovisual_id', $audiovisualId)
                ->where('user_id', $user)
                ->delete();

            // Redireccionar de nuevo a la página anterior
            return redirect()->back();
        }

        // Insertar o actualizar voto
        Votacion::updateOrInsert(
            ['audiovisual_id' => $audiovisualId, 'user_id' => $user],
            ['voto' => $voto]
        );

        // Redireccionar de nuevo a la página anterior
        return redirect()->back();
    }

    public function show(Votacion $votacion)
    {
        //
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
