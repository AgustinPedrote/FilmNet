<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.companies.index', ['companies' => $companies]);
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
    public function store(StoreCompanyRequest $request)
    {
        $nombre = $request->nombre;
        Company::create([
            'nombre' => $nombre,
        ]);

        return redirect()->route('admin.companies.index')->with('success', 'La compañía ha sido creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());

        return redirect()->route('admin.companies.index')->with('success', 'La compañía ha sido modificada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Verificar si la compan$company tiene roles relacionados
        if ($company->audiovisuales->isEmpty()) {

            $company->delete();

            return redirect()->route('admin.companies.index')->with('success', 'La compañía ha sido eliminada con éxito.');
        }

        // La compañía tiene roles relacionados, no se puede eliminar
        return redirect()->route('admin.companies.index')->with('error', 'Imposible eliminar compañía: tiene vínculos en uno o más audiovisuales');
    }
}
