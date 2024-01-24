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
        $nombre = $request->nombre;
        Company::create([
            'nombre' => $nombre,
        ]);

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
        $company->update($request->all());

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
