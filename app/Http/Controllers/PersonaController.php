<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Models\Persona;

class PersonaController extends Controller
{
    // Mostrar la lista paginada de personas
    public function index()
    {
        $personas = Persona::orderBy('nombre')->paginate(10);

        return view('admin.personas.index', ['personas' => $personas]);
    }

    public function create()
    {
        //
    }

    // Almacenar una nueva persona en la base de datos
    public function store(StorePersonaRequest $request)
    {
        // Validar las reglas de validación
        $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'regex:/^[^\d]+$/'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            'nombre.regex' => 'El nombre no puede contener números.',
        ]);

        // Creando un nuevo registro en la tabla 'personas'
        $nombre = $request->nombre;
        Persona::create([
            'nombre' => $nombre,
        ]);

        // Redireccionar de nuevo a la ficha técnica del audiovisual
        return redirect()->route('admin.personas.index')->with('success', 'La persona ha sido creada con éxito.');
    }


    // Mostrar detalles de una persona y su filmografía
    public function show(Persona $audiovisual)
    {
        $persona = $audiovisual;

        // Crear una colección vacía
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

        // Ordenar la filmografía por año de mayor a menor
        $filmografia = $filmografia->sortByDesc('year');

        return view('personas.show', compact('persona', 'filmografia'));
    }

    public function edit(Persona $persona)
    {
        //
    }

    // Actualizar la información de una persona en la base de datos
    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        // Validar las reglas de validación
        $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'regex:/^[^\d]+$/'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            'nombre.regex' => 'El nombre no puede contener números.',
        ]);

        // Actualizar la información de la persona con los datos validados
        $persona->update($request->all());

        // Redireccionar de nuevo a la ficha técnica del audiovisual
        return redirect()->route('admin.personas.index')->with('success', 'La persona ha sido modificada con éxito.');
    }


    // Eliminar una persona, verificando roles relacionados antes de la eliminación
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
