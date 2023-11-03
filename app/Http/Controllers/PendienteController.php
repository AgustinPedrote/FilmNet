<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePendienteRequest;
use App\Http\Requests\UpdatePendienteRequest;
use App\Models\Pendiente;

class PendienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePendienteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendiente $pendiente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendiente $pendiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendienteRequest $request, Pendiente $pendiente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendiente $pendiente)
    {
        //
    }
}
