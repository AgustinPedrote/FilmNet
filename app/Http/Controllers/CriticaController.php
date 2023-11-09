<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriticaRequest;
use App\Http\Requests\UpdateCriticaRequest;
use App\Models\Critica;

class CriticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function misCriticas()
    {
        // Obtén las criticas del usuario logado
        $criticas = auth()->user()->criticas;

        return view('criticas.index', compact('criticas'));
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
    public function store(StoreCriticaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Critica $critica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Critica $critica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCriticaRequest $request, Critica $critica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Critica $critica)
    {
        //
    }
}
