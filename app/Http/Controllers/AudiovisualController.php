<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAudiovisualRequest;
use App\Http\Requests\UpdateAudiovisualRequest;
use App\Models\Audiovisual;

class AudiovisualController extends Controller
{
    public function index()
    {
        // Obtener las últimas 6 películas ordenadas por id de forma descendente
        $peliculas = Audiovisual::where('tipo_id', 1)->latest('id')->take(6)->get();

        // Obtener las últimas 6 series ordenadas por id de forma descendente
        $series = Audiovisual::where('tipo_id', 2)->latest('id')->take(6)->get();

        // Obtener los últimos 6 documentales ordenados por id de forma descendente
        $documentales = Audiovisual::where('tipo_id', 3)->latest('id')->take(6)->get();

        // Pasar los datos a la vista 'home'
        return view('home', ['peliculas' => $peliculas, 'series' => $series, 'documentales' => $documentales]);
    }

    public function peliculasIndex()
    {
        return view('audiovisuales.peliculas');
    }

    public function seriesIndex()
    {
        return view('audiovisuales.series');
    }

    public function documentalesIndex()
    {
        return view('audiovisuales.documentales');
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
    public function store(StoreAudiovisualRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Audiovisual $audiovisual)
    {
        return view('audiovisuales.show', ['audiovisual' => $audiovisual]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audiovisual $audiovisual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAudiovisualRequest $request, Audiovisual $audiovisual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audiovisual $audiovisual)
    {
        //
    }
}
