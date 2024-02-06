<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    // Mostrar una lista paginada de compañías
    public function index()
    {
        $companies = Company::orderBy('nombre')->paginate(10);

        return view('admin.companies.index', ['companies' => $companies]);
    }


    public function create()
    {
        //
    }

    // Almacenar una nueva compañía recién creada en la base de datos
    public function store(StoreCompanyRequest $request)
    {
        // Validar las reglas de validación
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
        ]);

        // Crear una nueva compañía en la base de datos con los datos validados
        Company::create([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar de nuevo a la página de índice de compañías con un mensaje de éxito
        return redirect()->route('admin.companies.index')->with('success', 'La compañía ha sido creada con éxito.');
    }



    public function show(Company $company)
    {
        //
    }


    public function edit(Company $company)
    {
        //
    }

    // Actualizar la compañía especificada en la base de datos
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        // Validar las reglas de validación
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
        ]);

        // Actualizar la información de la compañía con los datos validados
        $company->update($request->all());

        // Redireccionar de nuevo a la página de índice de compañías con un mensaje de éxito
        return redirect()->route('admin.companies.index')->with('success', 'La compañía ha sido modificada con éxito.');
    }

    // Eliminar la compañía especificada
    public function destroy(Company $company)
    {
        // Verificar si la compañía tiene roles relacionados
        if ($company->audiovisuales->isEmpty()) {

            $company->delete();

            return redirect()->route('admin.companies.index')->with('success', 'La compañía ha sido eliminada con éxito.');
        }

        // La compañía tiene roles relacionados, no se puede eliminar
        return redirect()->route('admin.companies.index')->with('error', 'Imposible eliminar compañía: tiene vínculos en uno o más audiovisuales');
    }
}
