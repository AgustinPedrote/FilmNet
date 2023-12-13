<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePremioRequest;
use App\Http\Requests\UpdatePremioRequest;
use App\Models\Premio;

class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $premios = Premio::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.premios.index', ['premios' => $premios]);
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
    public function store(StorePremioRequest $request)
    {
        $nombre = $request->nombre;
        $year = $request->year;
        $audiovisual_id = $request->audiovisual;

        Premio::create([
            'nombre' => $nombre,
            'year' => $year,
            'audiovisual_id' => $audiovisual_id
        ]);

        return redirect()->route('admin.premios.index')->with('success', 'El premio ha sido creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Premio $premio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Premio $premio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePremioRequest $request, Premio $premio)
    {
        $premio->update($request->all());

        return redirect()->route('admin.premios.index')->with('success', 'El premio ha sido modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Premio $premio)
    {
        //
    }
}
