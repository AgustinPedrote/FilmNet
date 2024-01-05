<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePremioRequest;
use App\Http\Requests\UpdatePremioRequest;
use App\Models\Premio;
use App\Models\Audiovisual;
use Illuminate\Http\Request;

class PremioController extends Controller
{
    public function index()
    {
        $premios = Premio::orderBy('nombre')->paginate(10);

        return view('admin.premios.index', [
            'premios' => $premios
        ]);
    }

    public function create()
    {
        //
    }

    /* public function store(StorePremioRequest $request)
    {
        $nombre = $request->nombre;
        $year = $request->year;
        $audiovisual_id = $request->audiovisual_;

        Premio::create([
            'nombre' => $nombre,
            'year' => $year,
            'audiovisual_id' => $audiovisual_id
        ]);

        return redirect()->route('admin.premios.index')->with('success', 'El premio ha sido creado con éxito');
    } */

    public function store(StorePremioRequest $request)
    {
        // Validar si la búsqueda está vacía o no coincide con un audiovisual
        if (empty($request->audiovisual_)) {
            return redirect()->route('admin.premios.index')->with('error', 'El premio no ha sido creado con éxito');
        }

        // Validar que el año sea un número
        if (!is_numeric($request->year)) {
            return redirect()->route('admin.premios.index')->with('error', 'El año debe ser un número');
        }

        // Crear el premio
        $nombre = $request->nombre;
        $year = $request->year;
        $audiovisual_id = $request->audiovisual_;

        Premio::create([
            'nombre' => $nombre,
            'year' => $year,
            'audiovisual_id' => $audiovisual_id
        ]);

        return redirect()->route('admin.premios.index')->with('success', 'El premio ha sido creado con éxito');
    }

    public function show(Premio $premio)
    {
        //
    }

    public function edit(Premio $premio)
    {
        //
    }

    public function update(UpdatePremioRequest $request, Premio $premio)
    {
        if ($request->audiovisual_ != null) {
            $premio->audiovisual_id = $request->audiovisual_;
        }

        // Validar que el año sea un número
        if (!is_numeric($request->year)) {
            return redirect()->route('admin.premios.index')->with('error', 'El año debe ser un número');
        }

        $premio->update($request->all());

        return redirect()->route('admin.premios.index')->with('success', 'El premio ha sido modificado con éxito');
    }

    public function destroy(Premio $premio)
    {

        $premio->delete();

        return redirect()->route('admin.premios.index')->with('success', 'El premio ha sido eliminado con éxito.');
    }

    // Busqueda de audiovisuales para asignarlo al premio
    public function buscarAudiovisual(Request $request)
    {
        // Obtención del parámetro de búsqueda
        $query = $request->input('query');

        $resultados = Audiovisual::where('titulo', 'like', '%' . $query . '%')->get();

        return response()->json($resultados);
    }
}
