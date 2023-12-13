<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;
use App\Models\Genero;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.generos.index', ['generos' => $generos]);
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
    public function store(StoreGeneroRequest $request)
    {
        $nombre = $request->nombre;
        Genero::create([
            'nombre' => $nombre,
        ]);

        return redirect()->route('admin.generos.index')->with('success', 'El género ha sido creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genero $genero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genero $genero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGeneroRequest $request, Genero $genero)
    {
        $genero->update($request->all());

        return redirect()->route('admin.generos.index')->with('success', 'El género ha sido modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
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
