<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePremioRequest;
use App\Http\Requests\UpdatePremioRequest;
use Illuminate\Http\Request;
use App\Models\Premio;
use App\Models\Audiovisual;

class PremioController extends Controller
{
    // Mostrar la lista paginada de premios
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

    // Almacenar un nuevo premio en la base de datos
    public function store(StorePremioRequest $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'year' => ['required', 'integer', 'between:1900,' . date('Y')],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'year.required' => 'El año es obligatorio.',
            'year.integer' => 'El año debe ser un número entero.',
            'year.between' => 'El año debe estar entre 1900 y el año actual.',
        ]);

        // Validar que el audiovisual exista en la base de datos
        $audiovisual = Audiovisual::find($request->audiovisual_);
        if (!$audiovisual) {
            return redirect()->route('admin.premios.index')->with('error', 'El audiovisual seleccionado no existe');
        }

        // Crear el premio
        Premio::create([
            'nombre' => $request->nombre,
            'year' => $request->year,
            'audiovisual_id' => $request->audiovisual_
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

    // Actualizar la información de un premio en la base de datos
    public function update(UpdatePremioRequest $request, Premio $premio)
    {
        // Validar los campos del formulario
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'year' => ['required', 'integer', 'between:1900,' . date('Y')],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'year.required' => 'El año es obligatorio.',
            'year.integer' => 'El año debe ser un número entero.',
            'year.between' => 'El año debe estar entre 1900 y el año actual.',
        ]);

        // Verificar si el campo audiovisual_ está presente y no está vacío en la solicitud
        if ($request->filled('audiovisual_')) {
            $premio->audiovisual_id = $request->audiovisual_;
        }

        // Actualizar los datos del premio con los datos validados
        $premio->update($request->all());

        // Redireccionar de nuevo a la página de índice de premios con un mensaje de éxito
        return redirect()->route('admin.premios.index')->with('success', 'El premio ha sido modificado con éxito');
    }

    // Eliminar un premio de la base de datos
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

        $resultados = Audiovisual::where('titulo', 'ilike', '%' . $query . '%')->get();

        return response()->json($resultados);
    }
}
