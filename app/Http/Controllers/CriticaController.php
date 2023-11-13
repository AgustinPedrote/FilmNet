<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriticaRequest;
use App\Http\Requests\UpdateCriticaRequest;
use App\Models\Critica;

class CriticaController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreCriticaRequest $request)
    {
        // Obtener el ID del usuario autenticado
        $user = auth()->user()->id;

        // Obtener la crítica y el ID del audiovisual del formulario de solicitud
        $critica = $request->critica;
        $audiovisual = $request->audiovisual;

        // Crear una nueva instancia de la clase Critica y almacenarla en la base de datos
        Critica::create([
            'audiovisual_id' => $audiovisual,
            'user_id' => $user,
            'critica' => $critica,
        ]);

        // Redireccionar de nuevo a la página anterior (usualmente la página del audiovisual)
        return redirect()->back();
    }

    public function show(Critica $critica)
    {
        //
    }

    public function edit(Critica $critica)
    {
        //
    }

    public function update(UpdateCriticaRequest $request, Critica $critica)
    {
        //
    }

    public function destroy(Critica $critica)
    {
        //
    }
}
