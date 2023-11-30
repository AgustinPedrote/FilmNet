<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAudiovisualRequest;
use App\Http\Requests\UpdateAudiovisualRequest;
use App\Models\Audiovisual;

class AudiovisualController extends Controller
{
    public function index()
    {
        // Obtener las últimas 5 películas ordenadas por id de forma descendente
        $peliculas = Audiovisual::where('tipo_id', 1)->latest('id')->take(5)->get();

        // Obtener las últimas 5 series ordenadas por id de forma descendente
        $series = Audiovisual::where('tipo_id', 2)->latest('id')->take(5)->get();

        // Obtener los últimos 5 documentales ordenados por id de forma descendente
        $documentales = Audiovisual::where('tipo_id', 3)->latest('id')->take(5)->get();

        // Pasar los datos a la vista 'home'
        return view('home', ['peliculas' => $peliculas, 'series' => $series, 'documentales' => $documentales]);
    }

    // Obtener todas las películas ordenadas por id de forma descendente paginadas de 8 en 8
    public function peliculasIndex()
    {
        $peliculas = Audiovisual::where('tipo_id', 1)->latest('id')->paginate(10);

        return view('audiovisuales.peliculas', ['peliculas' => $peliculas]);
    }



    public function seriesIndex()
    {
        $series = Audiovisual::where('tipo_id', 2)->latest('id')->paginate(10);

        return view('audiovisuales.series', ['series' => $series]);
    }

    public function documentalesIndex()
    {
        $documentales = Audiovisual::where('tipo_id', 3)->latest('id')->paginate(10);

        return view('audiovisuales.documentales', ['documentales' => $documentales]);
    }

    public function create()
    {
        //
    }

    public function store(StoreAudiovisualRequest $request)
    {
        //
    }

    public function show(Audiovisual $audiovisual)
    {
        // Verifica si el usuario está autenticado
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $votacion = $audiovisual->obtenerVotacion($user_id, $audiovisual->id);
        } else {
            // Si el usuario no está autenticado, asigna null a $votacion
            $votacion = null;
        }

        // Calcula la nota media
        $notaMedia = $audiovisual->obtenerNotaMedia();

        // Obtiene el número de votos
        $numeroVotos = $audiovisual->obtenerNumeroVotos();

        return view('audiovisuales.show', ['audiovisual' => $audiovisual, 'votacion' => $votacion, 'notaMedia' => $notaMedia, 'numeroVotos' => $numeroVotos]);
    }



    public function edit(Audiovisual $audiovisual)
    {
        //
    }

    public function update(UpdateAudiovisualRequest $request, Audiovisual $audiovisual)
    {
        //
    }

    public function destroy(Audiovisual $audiovisual)
    {
        //
    }

    // Ver las criticas de una pelicula
    public function criticas($audiovisual)
    {
        $audiovisual = Audiovisual::find($audiovisual);
        $criticas = $audiovisual->criticas;

        // Calcula la nota media
        $notaMedia = $audiovisual->obtenerNotaMedia();

        return view('audiovisuales.criticas', ['audiovisual' => $audiovisual, 'criticas' => $criticas, 'notaMedia' => $notaMedia]);
    }
}
