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
        return view('admin.premios.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Premio $premio)
    {
        //
    }
}
