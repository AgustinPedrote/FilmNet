<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriticaRequest;
use App\Http\Requests\UpdateCriticaRequest;
use App\Models\Audiovisual;
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
        try {
            // Obtener el ID del usuario autenticado
            $user = auth()->user()->id;

            // Obtener la crítica y el ID del audiovisual del formulario de solicitud
            $critica = $request->critica;
            $audiovisual = $request->audiovisual;

            // Verificar si el usuario ya ha realizado una crítica para este audiovisual
            $existingCritica = Critica::where('user_id', $user)->where('audiovisual_id', $audiovisual)->first();

            if ($existingCritica) {
                // Si ya existe una crítica, redirigir con un mensaje de error
                return redirect()->back()->with('error', 'Ya has realizado una crítica para este audiovisual.');
            }

            // Verificar si la crítica está vacía
            if (empty($critica)) {
                // Si la crítica está vacía, redirigir con un mensaje de error
                return redirect()->back()->with('error', 'No puedes enviar una crítica vacía.');
            }

            // Crear una nueva instancia de la clase Critica y almacenarla en la base de datos
            Critica::create([
                'audiovisual_id' => $audiovisual,
                'user_id' => $user,
                'critica' => $critica,
            ]);

            // Redireccionar de nuevo a la página anterior con un mensaje de éxito
            return redirect()->back()->with('success', 'La crítica ha sido creada con éxito.');
        } catch (\Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir durante el proceso
            return redirect()->back()->with('error', 'Error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }
    }


    public function show(Critica $critica)
    {
        //
    }

    public function edit(Critica $critica)
    {
    }

    /*     public function update(UpdateCriticaRequest $request, Critica $critica)
    {
        $critica->update($request->all());
        return redirect()->route('users.criticas')->with('success', 'La critica se ha modificado correctamente');
    } */

    public function update(UpdateCriticaRequest $request, $usuario_id, $audiovisual_id)
    {
        try {
            // Intenta actualizar la crítica si ya existe, de lo contrario, la inserta
            Critica::updateOrInsert(
                ['user_id' => $usuario_id, 'audiovisual_id' => $audiovisual_id],
                ['critica' => $request->critica]
            );

            return redirect()->route('users.criticas')->with('success', 'La crítica se ha modificado correctamente');
        } catch (\Exception $e) {
            // Maneja cualquier excepción que pueda ocurrir durante el proceso
            return redirect()->back()->with('error', 'Error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }
    }


    public function destroy(StoreCriticaRequest $request)
    {

        // Obtener el ID del usuario autenticado
        $user = auth()->user()->id;

        // Obtener el ID del audiovisual y el critica del formulario de solicitud
        $audiovisualId = $request->audiovisual_id;

        // Eliminar la crítica correspondiente
        Critica::where('audiovisual_id', $audiovisualId)
            ->where('user_id', $user)
            ->delete();

        // Redireccionar de nuevo a la página anterior
        return redirect()->back();
    }
}
