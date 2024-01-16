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
        $nombre = $request->nombre;
        Genero::create([
            'nombre' => $nombre,
        ]);

        return redirect()->route('admin.generos.index')->with('success', 'El género ha sido creado con éxito');
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
        $genero->update($request->all());

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
