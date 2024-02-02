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
        // Validar las reglas de validación
        $validatedData = $request->validate([
            'titulo' => ['required', 'string', 'max:100'],
            'titulo_original' => ['nullable', 'string', 'max:100'],
            'year' => ['required', 'integer', 'between:1900,' . date('Y')],
            'duracion' => ['required', 'numeric', 'min:1'],
            'pais' => ['required', 'string', 'max:255', 'regex:/^[^\d]+$/'],
            'trailer' => ['nullable', 'url'],
            'tipo_id' => ['required', 'integer', 'exists:tipos,id'],
            'recomendacion_id' => ['required', 'integer', 'exists:recomendaciones,id'],
            'sinopsis' => ['required', 'string', 'max:500'],
            'imagen' => ['required', 'image', 'max:2048'], // Asegurar que la imagen sea un archivo de imagen válido y no exceda 2MB
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de caracteres.',
            'titulo.max' => 'El título no puede tener más de :max caracteres.',
            'titulo_original.string' => 'El título original debe ser una cadena de caracteres.',
            'titulo_original.max' => 'El título original no puede tener más de :max caracteres.',
            'year.required' => 'El año es obligatorio.',
            'year.integer' => 'El año debe ser un número entero.',
            'year.between' => 'El año debe estar entre 1900 y el año actual.',
            'duracion.required' => 'La duración es obligatoria.',
            'duracion.numeric' => 'La duración debe ser un número.',
            'duracion.min' => 'La duración debe ser al menos :min.',
            'pais.required' => 'El país es obligatorio.',
            'pais.string' => 'El país debe ser una cadena de caracteres.',
            'pais.regex' => 'El país no puede contener números.',
            'pais.max' => 'El país no puede tener más de :max caracteres.',
            'trailer.url' => 'El formato del trailer no es válido.',
            'tipo_id.required' => 'El tipo es obligatorio.',
            'tipo_id.integer' => 'El tipo debe ser un número entero.',
            'tipo_id.exists' => 'El tipo seleccionado no existe.',
            'recomendacion_id.required' => 'La recomendación de edad es obligatoria.',
            'recomendacion_id.integer' => 'La recomendación de edad debe ser un número entero.',
            'recomendacion_id.exists' => 'La recomendación de edad seleccionada no existe.',
            'sinopsis.required' => 'La sinopsis es obligatoria.',
            'sinopsis.string' => 'La sinopsis debe ser una cadena de caracteres.',
            'sinopsis.max' => 'La sinopsis no puede tener más de :max caracteres.',
            'imagen.required' => 'La imagen es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no puede exceder :max kilobytes.',
        ]);

        // Reemplazar los espacios en blanco con guiones bajos en el título
        $titulo = str_replace(' ', '_', $validatedData['titulo']);

        // Obtener la extensión del archivo original
        $extension = $request->file('imagen')->getClientOriginalExtension();

        // Construir el nombre de la imagen con el título modificado y la extensión
        $img = $titulo . '.' . $extension;

        // Mover el archivo a la ubicación deseada
        $request->file('imagen')->move(public_path('img'), $img);

        // Crear un nuevo registro de audiovisual en la base de datos
        Audiovisual::create([
            'titulo' => $validatedData['titulo'],
            'titulo_original' => $validatedData['titulo_original'],
            'year' => $validatedData['year'],
            'duracion' => $validatedData['duracion'],
            'pais' => $validatedData['pais'],
            'trailer' => $validatedData['trailer'],
            'tipo_id' => $validatedData['tipo_id'],
            'recomendacion_id' => $validatedData['recomendacion_id'],
            'sinopsis' => $validatedData['sinopsis'],
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

    // Actualizar la información de un audiovisual (Admin)
    public function update(UpdateAudiovisualRequest $request, Audiovisual $audiovisual)
    {
        // Verificar si se proporcionó una nueva imagen en la solicitud
        if ($request->hasFile('imagen')) {

            // Reemplazar los espacios en blanco con guiones bajos en el título
            $titulo = str_replace(' ', '_', $request->titulo);

            // Obtener la extensión del archivo original
            $extension = $request->file('imagen')->getClientOriginalExtension();

            // Construir el nombre de la imagen con el título modificado y la extensión
            $img = $titulo . '.' . $extension;

            // Mover el archivo a la ubicación deseada
            $request->file('imagen')->move(public_path('img'), $img);

            // Guardar la nueva imagen
            $audiovisual->img = 'img/' . $img;
            $audiovisual->save();
        }

        // Validar las reglas de validación
        $validatedData = $request->validate([
            'titulo' => ['required', 'string', 'max:100'],
            'titulo_original' => ['nullable', 'string', 'max:100'],
            'year' => ['required', 'integer', 'between:1900,' . date('Y')],
            'duracion' => ['required', 'numeric', 'min:1'],
            'pais' => ['required', 'string', 'max:255', 'regex:/^[^\d]+$/'],
            'trailer' => ['nullable', 'url'],
            'tipo_id' => ['required', 'integer', 'exists:tipos,id'],
            'recomendacion_id' => ['required', 'integer', 'exists:recomendaciones,id'],
            'sinopsis' => ['required', 'string', 'max:500'],
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de caracteres.',
            'titulo.max' => 'El título no puede tener más de :max caracteres.',
            'titulo_original.string' => 'El título original debe ser una cadena de caracteres.',
            'titulo_original.max' => 'El título original no puede tener más de :max caracteres.',
            'year.required' => 'El año es obligatorio.',
            'year.integer' => 'El año debe ser un número entero.',
            'year.between' => 'El año debe estar entre 1900 y el año actual.',
            'duracion.required' => 'La duración es obligatoria.',
            'duracion.numeric' => 'La duración debe ser un número.',
            'duracion.min' => 'La duración debe ser al menos :min.',
            'pais.required' => 'El país es obligatorio.',
            'pais.string' => 'El país debe ser una cadena de caracteres.',
            'pais.regex' => 'El país no puede contener números.',
            'pais.max' => 'El país no puede tener más de :max caracteres.',
            'trailer.url' => 'El formato del trailer no es válido.',
            'tipo_id.required' => 'El tipo es obligatorio.',
            'tipo_id.integer' => 'El tipo debe ser un número entero.',
            'tipo_id.exists' => 'El tipo seleccionado no existe.',
            'recomendacion_id.required' => 'La recomendación de edad es obligatoria.',
            'recomendacion_id.integer' => 'La recomendación de edad debe ser un número entero.',
            'recomendacion_id.exists' => 'La recomendación de edad seleccionada no existe.',
            'sinopsis.required' => 'La sinopsis es obligatoria.',
            'sinopsis.string' => 'La sinopsis debe ser una cadena de caracteres.',
            'sinopsis.max' => 'La sinopsis no puede tener más de :max caracteres.',
        ]);

        // Actualizar el audiovisual con los datos validados
        $audiovisual->update($validatedData);

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
        // Busca el audiovisual y obtiene todas las críticas
        $audiovisual = Audiovisual::find($audiovisual);
        $criticas = $audiovisual->criticas;

        // Si el usuario está logueado busca su crítica.
        if (auth()->check()) {
            $userCritica = $criticas->where('user_id', auth()->id())->first();

            // Excluye la crítica del usuario logueado y la añade al principio de la colección
            if ($userCritica) {
                $criticas = $criticas->reject(function ($critica) {
                    return $critica->user_id == auth()->id();
                })->prepend($userCritica);
            }
        }

        // Calcula la nota media del audiovisual
        $notaMedia = $audiovisual->obtenerNotaMedia();

        // Paginar las críticas con 4 elementos por página
        $perPage = 4;
        // Obtener el número de página actual
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Seleccionar los elementos que se mostrarán en la página actual
        $currentItems = $criticas->slice(($currentPage - 1) * $perPage, $perPage)->all(); // Los convierte en un array
        // Crea un nuevo objeto y añade: lista de elementos a mostrar, nº total de elmentos y nº de elementos por página
        $criticasPaginadas = new LengthAwarePaginator($currentItems, $criticas->count(), $perPage);

        // Establece la ruta correcta para los enlaces de paginación
        $criticasPaginadas->withPath(route('ver.criticas', ['audiovisual' => $audiovisual->id]));

        return view('audiovisuales.criticas', [
            'audiovisual' => $audiovisual,
            'criticas' => $criticasPaginadas, // críticas paginadas y la información de paginación
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
        // Obtener los resultados de búsqueda desde la solicitud
        $nombreGenero = $request->input('search_genero');
        $nombreCompany = $request->input('search_company');
        $nombreReparto = $request->input('search_reparto');
        $nombreGuionista = $request->input('search_guionista');
        $nombreFotografia = $request->input('search_fotografia');
        $nombreCompositor = $request->input('search_compositor');
        $nombreDirector = $request->input('search_director');

        // Verificar si se proporcionó al menos un término de búsqueda
        if (!$nombreGenero && !$nombreCompany && !$nombreReparto && !$nombreGuionista && !$nombreFotografia && !$nombreCompositor && !$nombreDirector) {
            return redirect()->route('admin.audiovisuales.index')->with('error', 'No se ha realizado ninguna modificación.');
        }

        /* // Verificar si se proporcionó información, buscar en la base de datos o crear una nueva instancia sin guardarla automáticamente.
              Si no estaba en la base de datos, redirecciona con mensaje de error y si estaba en la base de datos asociar al audiovisual sin elminar los existentes */

        // Genero
        if ($nombreGenero) {
            $genero = Genero::firstOrNew(['nombre' => $nombreGenero]);

            if (!$genero->exists) {
                return redirect()->route('admin.audiovisuales.index')->with('error', 'El género no existe en la base de datos.');
            }

            $audiovisual->generos()->syncWithoutDetaching([$genero->id]);
        }

        // Compañía
        if ($nombreCompany) {
            $company = Company::firstOrNew(['nombre' => $nombreCompany]);

            if (!$company->exists) {
                return redirect()->route('admin.audiovisuales.index')->with('error', 'La compañía no existe en la base de datos.');
            }

            $audiovisual->companies()->syncWithoutDetaching([$company->id]);
        }

        // Reparto
        if ($nombreReparto) {
            $reparto = Persona::firstOrNew(['nombre' => $nombreReparto]);

            if (!$reparto->exists) {
                return redirect()->route('admin.audiovisuales.index')->with('error', 'El reparto no existe en la base de datos.');
            }

            $audiovisual->repartos()->syncWithoutDetaching([$reparto->id]);
        }

        // Guionista
        if ($nombreGuionista) {
            $guionista = Persona::firstOrNew(['nombre' => $nombreGuionista]);

            if (!$guionista->exists) {
                return redirect()->route('admin.audiovisuales.index')->with('error', 'El guionista no existe en la base de datos.');
            }

            $audiovisual->guionistas()->syncWithoutDetaching([$guionista->id]);
        }

        // Fotografía
        if ($nombreFotografia) {
            $fotografia = Persona::firstOrNew(['nombre' => $nombreFotografia]);

            if (!$fotografia->exists) {
                return redirect()->route('admin.audiovisuales.index')->with('error', 'El fotógrafo no existe en la base de datos.');
            }

            $audiovisual->fotografias()->syncWithoutDetaching([$fotografia->id]);
        }

        // Compositor
        if ($nombreCompositor) {
            $compositor = Persona::firstOrNew(['nombre' => $nombreCompositor]);

            if (!$compositor->exists) {
                return redirect()->route('admin.audiovisuales.index')->with('error', 'El compositor no existe en la base de datos.');
            }

            $audiovisual->compositores()->syncWithoutDetaching([$compositor->id]);
        }

        // Director
        if ($nombreDirector) {
            $director = Persona::firstOrNew(['nombre' => $nombreDirector]);

            if (!$director->exists) {
                return redirect()->route('admin.audiovisuales.index')->with('error', 'El director no existe en la base de datos.');
            }

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
