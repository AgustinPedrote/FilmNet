<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.personas.index', ['personas' => $personas]);
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
    public function store(StorePersonaRequest $request)
    {
        $nombre = $request->nombre;
        Persona::create([
            'nombre' => $nombre,
        ]);

        // Redireccionar de nuevo a la ficha técnica del audiovisual
        return redirect()->route('admin.personas.index')->with('success', 'La persona ha sido creada con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonaRequest $request, Persona $persona)
    {

        $persona->update($request->all());

        // Redireccionar de nuevo a la ficha técnica del audiovisual
        return redirect()->route('admin.personas.index')->with('success', 'La persona ha sido modificada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Persona $persona)
    {
        // Verificar si la persona tiene roles relacionados
        if ($persona->directores->isEmpty() && $persona->guionistas->isEmpty() && $persona->compositores->isEmpty() && $persona->repartos->isEmpty() && $persona->fotografias->isEmpty()) {
            // No tiene roles relacionados, entonces se puede eliminar
            $persona->delete();

            return redirect()->route('admin.personas.index')->with('success', 'La persona ha sido eliminada con éxito.');
        }

        // La persona tiene roles relacionados, no se puede eliminar
        return redirect()->route('admin.personas.index')->with('error', 'Imposible eliminar persona: tiene vínculos en uno o más audiovisuales');
    }
}
