<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAudiovisualRequest;
use App\Http\Requests\UpdateAudiovisualRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Models\Audiovisual;
use App\Models\Recomendacion;
use App\Models\Tipo;
use App\Models\Genero;
use App\Models\Company;
use App\Models\Persona;


class AudiovisualController extends Controller
{
    // Mostrar la página principal con la lista de audiovisuales (HOME)
    public function index()
    {
        $audiovisuales = Audiovisual::orderBy('titulo')->get();
        $generos = Genero::all();
        $tipos = Tipo::all();
        $recomendaciones = Recomendacion::all();

        return view('home', [
            'audiovisuales' => $audiovisuales,
            'generos' => $generos,
            'tipos' => $tipos,
            'recomendaciones' => $recomendaciones,
        ]);
    }

    // Realizar la búsqueda de audiovisuales con filtros (HOME)
    public function buscarAudiovisual(Request $request)
    {
        // Obtener los parámetros de búsqueda desde la solicitud
        $titulo = $request->input('search');
        $genero = $request->input('genre');
        $tipo = $request->input('type');
        $recomendacion = $request->input('recommendation');

        // Crear una instancia de la consulta Eloquent para el modelo Audiovisual
        $query = Audiovisual::query();

        // Agregar condiciones a la consulta en función de los parámetros de búsqueda
        if (!empty($titulo)) {
            $query->where('titulo', 'ilike', '%' . $titulo . '%');
        }

        // Agregar condición para género
        if (!empty($genero)) {
            // Filtrar resultados
            $query->whereHas('generos', function ($q) use ($genero) {
                $q->where('genero_id', $genero);
            });
        }

        // Agregar condición para tipo de audiovisual
        if (!empty($tipo)) {
            $query->where('tipo_id', $tipo);
        }

        // Agregar condición para recomendación de edad
        if (!empty($recomendacion)) {
            if ($recomendacion === 'todos') {
                $query->where('recomendacion_id', '=', 1);
            } elseif ($recomendacion === 'mayores_13') {
                $query->where('recomendacion_id', '=', 2);
            } elseif ($recomendacion === 'mayores_18') {
                $query->where('recomendacion_id', '=', 3);
            }
        }

        // Ejecutar la consulta y obtener los resultados
        $resultados = $query->orderBy('titulo')->get();

        // Cargar la vista parcial '_busqueda' con los resultados
        $view = view('audiovisuales._busqueda', ['items' => $resultados]);

        // Devolver el HTML generado por la vista para ser utilizado en la respuesta y renderizado en el home
        return $view->render();
    }

    // Mostrar listas de novedades de películas.
    public function peliculasIndex()
    {
        // Obtener todas las películas ordenadas por id de forma descendente paginadas de 10 en 10
        $peliculas = Audiovisual::where('tipo_id', 1)->latest('id')->paginate(10);

        return view('audiovisuales.peliculas', [
            'peliculas' => $peliculas
        ]);
    }

    // Mostrar listas de novedades de series.
    public function seriesIndex()
    {
        // Obtener todas las series ordenadas por id de forma descendente paginadas de 10 en 10
        $series = Audiovisual::where('tipo_id', 2)->latest('id')->paginate(10);

        return view('audiovisuales.series', [
            'series' => $series
        ]);
    }

    // Mostrar listas de novedades de documentales.
    public function documentalesIndex()
    {
        // Obtener todas las documentales ordenadas por id de forma descendente paginadas de 10 en 10
        $documentales = Audiovisual::where('tipo_id', 3)->latest('id')->paginate(10);

        return view(
            'audiovisuales.documentales',
            ['documentales' => $documentales]
        );
    }

    // Mostrar la página principal de adminitración de audiovisuales (Admin)
    public function adminIndex()
    {
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

    // Almacenar un nuevo audiovisual en la base de datos (Admin)
    public function store(StoreAudiovisualRequest $request)
    {
        // Validar que se haya seleccionado un tipo de audiovisual
        if (!$request->has('tipo_id') || $request->tipo_id == 0) {
            return redirect()->route('admin.audiovisuales.index')->with('error', 'Debes seleccionar un tipo de audiovisual.');
        }

        // Validar que se haya seleccionado una recomendación de edad
        if (!$request->has('recomendacion_id') || $request->recomendacion_id == 0) {
            return redirect()->route('admin.audiovisuales.index')->with('error', 'Debes seleccionar una recomendación de edad.');
        }

        // Validar que se haya subido un archivo de imagen
        if (!$request->hasFile('imagen')) {
            return redirect()->route('admin.audiovisuales.index')->with('error', 'Debes seleccionar una imagen.');
        }

        // Reemplaza los espacios en blanco con guiones bajos en el título
        $titulo = str_replace(' ', '_', $request->titulo);

        // Obtén la extensión del archivo original
        $extension = $request->file('imagen')->getClientOriginalExtension();

        // Construye el nombre de la imagen con el título modificado y la extensión
        $img = $titulo . '.' . $extension;

        // Mueve el archivo a la ubicación deseada
        $request->file('imagen')->move(public_path('img'), $img);

        // Validar que el año o la duración sea un número
        if (!is_numeric($request->year) || !is_numeric($request->duracion)) {
            return redirect()->route('admin.audiovisuales.index')->with('error', 'Los campos año y duración son numéricos');
        }

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


    // Mostrar la ficha técnica de un audiovisual (SHOW)
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

    // actualizar la información de un audiovisual (Admin)
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

        // Validar que el año o la duración sea un número
        if (!is_numeric($request->year) || !is_numeric($request->duracion)) {
            return redirect()->route('admin.audiovisuales.index')->with('error', 'Los campos año y duración son numéricos');
        }

        $audiovisual->update($request->all());

        return redirect()->route('admin.audiovisuales.index')->with('success', 'El audiovisual ha sido modificado con éxito');
    }

    // Eliminar un audiovisual de la base de datos (Admin)
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

    // Buscar géneros en la base de datos y devolver los resultados (Admin)
    public function buscarGenero(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Genero::where('nombre', 'ilike', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['generos' => $resultados]);
    }

    // Buscar compañías en la base de datos y devolver los resultados (Admin)
    public function buscarCompany(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Company::where('nombre', 'ilike', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['companies' => $resultados]);
    }

    // Buscar reparto en la base de datos y devolver los resultados (Admin)
    public function buscarReparto(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Persona::where('nombre', 'ilike', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['repartos' => $resultados]);
    }

    // Buscar guionistas en la base de datos y devolver los resultados (Admin)
    public function buscarGuionista(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Persona::where('nombre', 'ilike', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['guionistas' => $resultados]);
    }

    // Buscar directores de fotografía en la base de datos y devolver los resultados (Admin)
    public function buscarFotografia(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Persona::where('nombre', 'ilike', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['fotografias' => $resultados]);
    }

    // Buscar compositores en la base de datos y devolver los resultados (Admin)
    public function buscarCompositor(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Persona::where('nombre', 'ilike', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['compositores' => $resultados]);
    }

    // Buscar directores en la base de datos y devolver los resultados (Admin)
    public function buscarDirector(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos y obtén los resultados
        $resultados = Persona::where('nombre', 'ilike', '%' . $query . '%')->get();

        // Devuelve los resultados como parte de un arreglo asociativo
        return response()->json(['directores' => $resultados]);
    }

    // Actualizar la información del elenco del audiovisual (Admin)
    public function updateBusqueda(Request $request, Audiovisual $audiovisual)
    {
        // Obtén el nombre del género y la compañía desde la solicitud
        $nombreGenero = $request->input('search_genero');
        $nombreCompany = $request->input('search_company');
        $nombreReparto = $request->input('search_reparto');
        $nombreGuionista = $request->input('search_guionista');
        $nombreFotografia = $request->input('search_fotografia');
        $nombreCompositor = $request->input('search_compositor');
        $nombreDirector = $request->input('search_director');

        // Verificar si se proporcionó información para el género y la compañía
        if ($nombreGenero) {
            // Busca en la base de datos o crea uno nuevo si no existe
            $genero = Genero::firstOrCreate(['nombre' => $nombreGenero]);

            // Asociar al audiovisual sin eliminar los existentes
            $audiovisual->generos()->syncWithoutDetaching([$genero->id]);
        }

        if ($nombreCompany) {
            $company = Company::firstOrCreate(['nombre' => $nombreCompany]);

            $audiovisual->companies()->syncWithoutDetaching([$company->id]);
        }

        if ($nombreReparto) {
            $reparto = Persona::firstOrCreate(['nombre' => $nombreReparto]);

            $audiovisual->repartos()->syncWithoutDetaching([$reparto->id]);
        }

        if ($nombreGuionista) {
            $guionista = Persona::firstOrCreate(['nombre' => $nombreGuionista]);

            $audiovisual->guionistas()->syncWithoutDetaching([$guionista->id]);
        }

        if ($nombreFotografia) {
            $fotografia = Persona::firstOrCreate(['nombre' => $nombreFotografia]);

            $audiovisual->fotografias()->syncWithoutDetaching([$fotografia->id]);
        }

        if ($nombreCompositor) {
            $compositor = Persona::firstOrCreate(['nombre' => $nombreCompositor]);

            $audiovisual->compositores()->syncWithoutDetaching([$compositor->id]);
        }

        if ($nombreDirector) {
            $director = Persona::firstOrCreate(['nombre' => $nombreDirector]);

            $audiovisual->directores()->syncWithoutDetaching([$director->id]);
        }

        return redirect()->route('admin.audiovisuales.index')->with('success', 'El elenco ha sido modificado con éxito');
    }

    // Eliminar relaciones del audiovisual, relacionados con el Elenco y el Equipo, de la base de datos (Admin)
    public function eliminarRelacion(Audiovisual $audiovisual, $tipoRelacion, $idRelacion)
    {
        // Buscar la relación específica en el modelo de Audiovisual
        $relacion = $audiovisual->{$tipoRelacion}()->find($idRelacion);

        // Verificar si se encontró la relación
        if ($relacion) {
            $audiovisual->{$tipoRelacion}()->detach($idRelacion);
            $mensaje = "{$relacion->nombre} eliminado correctamente.";
            $success = true;
        } else {
            $mensaje = 'Error al eliminar la relación.';
            $success = false;
        }

        // Devolver una respuesta JSON indicando el éxito de la operación y un mensaje descriptivo
        return response()->json(['success' => $success, 'message' => $mensaje]);
    }

    // Eliminar todas las relaciones de Elenco y Equipo
    public function eliminarTodoElenco($audiovisualId)
    {
        // Buscar el audiovisual
        $audiovisual = Audiovisual::find($audiovisualId);

        // Verificar si el audiovisual existe
        if (!$audiovisual) {
            return response()->json(['success' => false, 'message' => 'Audiovisual no encontrado'], 404);
        }

        // Desvincular todas las relaciones
        $audiovisual->directores()->detach();
        $audiovisual->compositores()->detach();
        $audiovisual->fotografias()->detach();
        $audiovisual->guionistas()->detach();
        $audiovisual->repartos()->detach();
        $audiovisual->companies()->detach();
        $audiovisual->generos()->detach();

        // Devolver una respuesta JSON
        return response()->json(['success' => true, 'message' => 'Todas las relaciones eliminadas con éxito']);
    }
}
