<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;
use App\Models\Genero;

class GeneroController extends Controller
{
    // Mostrar la lista paginada de géneros
    public function index()
    {
        $generos = Genero::orderBy('nombre')->paginate(10);

        return view('admin.generos.index', ['generos' => $generos]);
    }

    public function create()
    {
        //
    }

    // Almacenar un nuevo género en la base de datos
    public function store(StoreGeneroRequest $request)
    {
        // Validar las reglas de validación
        $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'regex:/^[^0-9]+$/'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            'nombre.regex' => 'El nombre no puede contener números.',
        ]);

        // Crear un nuevo género en la base de datos con los datos validados
        Genero::create([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar de nuevo a la página de índice de géneros con un mensaje de éxito
        return redirect()->route('admin.generos.index')->with('success', 'El género ha sido creado con éxito.');
    }


    public function show(Genero $genero)
    {
        //
    }

    public function edit(Genero $genero)
    {
        //
    }

    // Método para actualizar la información de un género en la base de datos
    public function update(UpdateGeneroRequest $request, Genero $genero)
    {
        // Validar las reglas de validación
        $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'regex:/^[^0-9]+$/'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            'nombre.regex' => 'El nombre no puede contener números.',
        ]);

        // Actualizar la información del género con los datos validados
        $genero->update($request->all());

        // Redireccionar de nuevo a la página de índice de géneros con un mensaje de éxito
        return redirect()->route('admin.generos.index')->with('success', 'El género ha sido modificado con éxito');
    }

    // Método para eliminar un género, verificando si tiene roles relacionados
    public function destroy(Genero $genero)
    {
        // Verificar si el género tiene roles relacionados (audiovisuales)
        if ($genero->audiovisuales->isEmpty()) {
            // No tiene roles relacionados, entonces se puede eliminar
            $genero->delete();

            return redirect()->route('admin.generos.index')->with('success', 'El género ha sido eliminado con éxito.');
        }

        // El género tiene roles relacionados, no se puede eliminar
        return redirect()->route('admin.generos.index')->with('error', 'Imposible eliminar género: tiene vínculos en uno o más audiovisuales');
    }
}
