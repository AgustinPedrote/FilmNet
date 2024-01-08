<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::orderBy('nombre')->paginate(10);

        return view('admin.personas.index', ['personas' => $personas]);
    }

    public function create()
    {
        //
    }

    public function store(StorePersonaRequest $request)
    {
        $nombre = $request->nombre;
        Persona::create([
            'nombre' => $nombre,
        ]);

        // Redireccionar de nuevo a la ficha técnica del audiovisual
        return redirect()->route('admin.personas.index')->with('success', 'La persona ha sido creada con éxito.');
    }

    // Hay que comprobar si es director, actor, etc y poner sus audiovisuales.
    // PersonaController.php

    public function show(Persona $audiovisual)
    {
        $persona = $audiovisual;

        $filmografia = collect();

        // Obtener la filmografía combinada de todos los roles
        if ($persona->directores()->exists()) {
            $filmografia = $filmografia->merge($persona->directores);
        }

        if ($persona->repartos()->exists()) {
            $filmografia = $filmografia->merge($persona->repartos);
        }

        if ($persona->fotografias()->exists()) {
            $filmografia = $filmografia->merge($persona->fotografias);
        }

        if ($persona->compositores()->exists()) {
            $filmografia = $filmografia->merge($persona->compositores);
        }

        if ($persona->guionistas()->exists()) {
            $filmografia = $filmografia->merge($persona->guionistas);
        }

        // Eliminar duplicados de la colección combinada
        $filmografia = $filmografia->unique('id');

        return view('personas.show', compact('persona', 'filmografia'));
    }



    public function edit(Persona $persona)
    {
        //
    }

    public function update(UpdatePersonaRequest $request, Persona $persona)
    {

        $persona->update($request->all());

        // Redireccionar de nuevo a la ficha técnica del audiovisual
        return redirect()->route('admin.personas.index')->with('success', 'La persona ha sido modificada con éxito.');
    }

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
