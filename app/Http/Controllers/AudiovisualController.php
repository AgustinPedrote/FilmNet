<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAudiovisualRequest;
use App\Http\Requests\UpdateAudiovisualRequest;
use App\Models\Audiovisual;
use App\Models\Recomendacion;
use App\Models\Tipo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\Genero;
use App\Models\Company;
use App\Models\Persona;


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

        return view('home', [
            'peliculas' => $peliculas,
            'series' => $series,
            'documentales' => $documentales
        ]);
    }

    public function peliculasIndex()
    {
        // Obtener todas las películas ordenadas por id de forma descendente paginadas de 10 en 10
        $peliculas = Audiovisual::where('tipo_id', 1)->latest('id')->paginate(10);

        return view('audiovisuales.peliculas', [
            'peliculas' => $peliculas
        ]);
    }

    public function seriesIndex()
    {
        // Obtener todas las series ordenadas por id de forma descendente paginadas de 10 en 10
        $series = Audiovisual::where('tipo_id', 2)->latest('id')->paginate(10);

        return view('audiovisuales.series', [
            'series' => $series
        ]);
    }

    public function documentalesIndex()
    {
        // Obtener todas las documentales ordenadas por id de forma descendente paginadas de 10 en 10
        $documentales = Audiovisual::where('tipo_id', 3)->latest('id')->paginate(10);

        return view(
            'audiovisuales.documentales',
            ['documentales' => $documentales]
        );
    }

    // Panel de control del administrador
    public function adminIndex()
    {
        // Cargar explícitamente las relaciones necesarias para el modal.
        $audiovisuales = Audiovisual::with([
            'tipo',
            'companies',
            'recomendacion',
            'directores',
            'compositores',
            'fotografias',
            'guionistas',
            'repartos',
            'generos'
        ])
            ->orderBy('titulo')
            ->paginate(5);

        $tipos = Tipo::all();
        $recomendaciones = Recomendacion::all();

        return view('admin.audiovisuales.index', [
            'audiovisuales' => $audiovisuales,
            'tipos' => $tipos,
            'recomendaciones' => $recomendaciones
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreAudiovisualRequest $request)
    {
        // Reemplaza los espacios en blanco con guiones bajos en el título
        $titulo = str_replace(' ', '_', $request->titulo);

        // Obtén la extensión del archivo original
        $extension = $request->file('imagen')->getClientOriginalExtension();

        // Construye el nombre de la imagen con el título modificado y la extensión
        $img = $titulo . '.' . $extension;

        // Mueve el archivo a la ubicación deseada
        $request->file('imagen')->move(public_path('img'), $img);

        Audiovisual::create([
            'titulo' => $request->titulo,
            'titulo_original' => $request->titulo_original,
            'year' => $request->year,
            'duracion' => $request->duracion,
            'pais' => $request->pais,
            'trailer' => $request->trailer,
            'tipo_id' => $request->tipo_id,
            'recomendacion_id' => $request->recomendacion_id,
            'sinopsis' => $request->sinopsis,
            'img' => 'img/' . $img
        ]);

        return redirect()->route('admin.audiovisuales.index')->with('success', 'El audiovisual ha sido creado con éxito');
    }


    // Ficha técnica del audiovisual
    public function show(Audiovisual $audiovisual)
    {
        // Verifica si el usuario está autenticado
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $votacion = $audiovisual->obtenerVotacion($user_id, $audiovisual->id);
        } else {
            $votacion = null;
        }

        // Calcula la nota media
        $notaMedia = $audiovisual->obtenerNotaMedia();

        // Obtiene el número de votos
        $numeroVotos = $audiovisual->obtenerNumeroVotos();

        return view('audiovisuales.show', [
            'audiovisual' => $audiovisual,
            'votacion' => $votacion,
            'notaMedia' => $notaMedia,
            'numeroVotos' => $numeroVotos
        ]);
    }

    public function edit(Audiovisual $audiovisual)
    {
        //
    }

    public function update(UpdateAudiovisualRequest $request, Audiovisual $audiovisual)
    {
        // Verifica si se proporcionó una nueva imagen en la solicitud
        if ($request->hasFile('imagen')) {

            // Reemplaza los espacios en blanco con guiones bajos en el título
            $titulo = str_replace(' ', '_', $request->titulo);

            // Obtén la extensión del archivo original
            $extension = $request->file('imagen')->getClientOriginalExtension();

            // Construye el nombre de la imagen con el título modificado y la extensión
            $img = $titulo . '.' . $extension;

            // Mueve el archivo a la ubicación deseada
            $request->file('imagen')->move(public_path('img'), $img);

            // Guarda la nueva imagen
            $audiovisual->img = 'img/' . $img;
            $audiovisual->save();
        }

        $audiovisual->update($request->all());

        return redirect()->route('admin.audiovisuales.index')->with('success', 'El audiovisual ha sido modificado con éxito');
    }

    public function destroy(Audiovisual $audiovisual)
    {
        $audiovisual->delete();

        return redirect()->route('admin.audiovisuales.index')->with('success', 'El audiovisual ha sido eliminado con éxito.');
    }

    // Críticas del audiovisual (paginados)
    public function criticas($audiovisual)
    {
        $audiovisual = Audiovisual::find($audiovisual);
        $criticas = $audiovisual->criticas;

        // Si el usuario está logueado, mover su crítica al principio de la lista
        if (auth()->check()) {
            $userCritica = $criticas->where('user_id', auth()->id())->first();

            // Verificar si se encontró una crítica del usuario
            if ($userCritica) {
                $criticas = $criticas->reject(function ($critica) {
                    return $critica->user_id == auth()->id();
                })->prepend($userCritica);
            }
        }

        // Calcula la nota media
        $notaMedia = $audiovisual->obtenerNotaMedia();

        // Pagina las críticas con 4 elementos por página
        $perPage = 4;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $criticas->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $criticasPaginadas = new LengthAwarePaginator($currentItems, $criticas->count(), $perPage);

        // Establece la ruta correcta para los enlaces de paginación
        $criticasPaginadas->withPath(route('ver.criticas', ['audiovisual' => $audiovisual->id]));

        return view('audiovisuales.criticas', [
            'audiovisual' => $audiovisual,
            'criticas' => $criticasPaginadas,
            'notaMedia' => $notaMedia
        ]);
    }


    // Funcionalidades del Panel de Administrador

    public function buscarGenero(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Genero::where('nombre', 'like', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['generos' => $resultados]);
    }

    public function buscarCompany(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Company::where('nombre', 'like', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['companies' => $resultados]);
    }

    public function updateBusqueda(Request $request, Audiovisual $audiovisual)
    {
        // Obtén el nombre del género y la compañía desde la solicitud
        $nombreGenero = $request->input('search_genero');
        $nombreCompany = $request->input('search_company');

        // Verificar si se proporcionó información para el género y la compañía
        if ($nombreGenero) {
            // Busca en la base de datos o crea uno nuevo si no existe
            $genero = Genero::firstOrCreate(['nombre' => $nombreGenero]);

            // Asociar al audiovisual sin eliminar los existentes
            $audiovisual->generos()->syncWithoutDetaching([$genero->id]);
        }

        if ($nombreCompany) {
            // Busca en la base de datos o crea uno nuevo si no existe
            $company = Company::firstOrCreate(['nombre' => $nombreCompany]);

            // Asociar al audiovisual sin eliminar los existentes
            $audiovisual->companies()->syncWithoutDetaching([$company->id]);
        }

        return redirect()->route('admin.audiovisuales.index')->with('success', 'El elenco ha sido modificado con éxito');
    }


    public function eliminarGenero(Audiovisual $audiovisual, Genero $genero)
    {
        $audiovisual->generos()->detach($genero->id);

        return redirect()->route('admin.audiovisuales.index', $audiovisual)
            ->with('success', 'Género eliminado correctamente.');
    }

    public function eliminarCompania(Audiovisual $audiovisual, Company $company)
    {
        $audiovisual->companies()->detach($company->id);

        return redirect()->route('admin.audiovisuales.index', $audiovisual)
            ->with('success', 'Compañía eliminada correctamente.');
    }

    public function eliminarDirector(Audiovisual $audiovisual, Persona $director)
    {
        $audiovisual->directores()->detach($director->id);

        return redirect()->route('admin.audiovisuales.index', $audiovisual)
            ->with('success', 'Director eliminado correctamente.');
    }

    public function eliminarCompositor(Audiovisual $audiovisual, Persona $compositor)
    {
        $audiovisual->compositores()->detach($compositor->id);

        return redirect()->route('admin.audiovisuales.index', $audiovisual)
            ->with('success', 'Compositor eliminado correctamente.');
    }

    public function eliminarFotografia(Audiovisual $audiovisual, Persona $fotografia)
    {
        $audiovisual->fotografias()->detach($fotografia->id);

        return redirect()->route('admin.audiovisuales.index', $audiovisual)
            ->with('success', 'Director de fotografía eliminado correctamente.');
    }

    public function eliminarGuionista(Audiovisual $audiovisual, Persona $guionista)
    {
        $audiovisual->guionistas()->detach($guionista->id);

        return redirect()->route('admin.audiovisuales.index', $audiovisual)
            ->with('success', 'Guionista eliminado correctamente.');
    }

    public function eliminarReparto(Audiovisual $audiovisual, Persona $reparto)
    {
        $audiovisual->repartos()->detach($reparto->id);

        return redirect()->route('admin.audiovisuales.index', $audiovisual)
            ->with('success', 'Actor/actriz eliminado correctamente.');
    }
}
