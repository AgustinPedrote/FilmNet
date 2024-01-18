<?php

use App\Http\Controllers\AudiovisualController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CriticaController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\VotacionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/* PERFIL */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/* INICIO FILMNET */
// Index de Filmnet
Route::get('/', [AudiovisualController::class, 'index'])->name('home.index')->middleware('ValidadoMiddleware');
// Buscador principal de audiovisuales
Route::get('/buscar-audiovisual', [AudiovisualController::class, 'buscarAudiovisual'])->name('buscar.audiovisual');


/* SECCIONES DE AUDIOVISUALES */
// Películas.
Route::get('peliculas', [AudiovisualController::class, 'peliculasIndex'])->name('peliculas.index');
// Series.
Route::get('series', [AudiovisualController::class, 'seriesIndex'])->name('series.index');
// Documentales
Route::get('documentales', [AudiovisualController::class, 'documentalesIndex'])->name('documentales.index');


/* FICHA TÉCNICA DEL AUDIOVISUAL */
Route::get('/audiovisual/{audiovisual}', [AudiovisualController::class, 'show'])->name('audiovisual.show');
// Votar audiovisual.
Route::post('/votaciones/create', [VotacionController::class, 'store'])->name('votaciones.store');
// Mostrar votación del usuario
Route::post('/votaciones/show', [VotacionController::class, 'show'])->name('votaciones.show');
// Ver crítica del audiovisual.
Route::get('audivisual/criticas/{audiovisual}', [AudiovisualController::class, 'criticas'])->name('ver.criticas');
// Crear crítica del audiovisual.
Route::post('criticas/create/{audiovisual}', [CriticaController::class, 'store'])->name('criticas.store');
// Seguimiento asíncrono
Route::post('/seguimiento/toggle', [UserController::class, 'toggleSeguimiento'])->name('toggle.seguimiento');


/* FILMOGRAFÍA DE LAS PERSONAS */
Route::get('/personas/{audiovisual}', [PersonaController::class, 'show'])->name('filmoteca.show');


/* MENÚ DE USUARIO */
// Mis votaciones.
Route::get('mis_votaciones', [UserController::class, 'misVotaciones'])->name('votaciones.index');
// Mis críticas.
Route::get('mis_criticas', [UserController::class, 'miscriticas'])->name('users.criticas');
// Mis críticas, editar.
Route::put('/criticas/edit/{usuario_id}/{audiovisual_id}', [CriticaController::class, 'update'])->name('criticas.update');
// Mis críticas, borrar.
Route::delete('/criticas/{usuario_id}/{audiovisual_id}', [CriticaController::class, 'destroy'])->name('criticas.destroy');
// Mis seguimientos de audiovisuales.
Route::get('seguimientos', [UserController::class, 'seguimientos'])->name('seguimientos.index');
// Mis amigos. Usuarios seguidores.
Route::get('seguidores', [UserController::class, 'seguidores'])->name('amigos.usuariosSeguidores');
// Mis amigos. Usuarios seguidos.
Route::get('seguidos', [UserController::class, 'seguidos'])->name('amigos.usuariosSeguidos');
// Mis amigos. Buscador.
Route::get('/busqueda/amigo', [UserController::class, 'buscarAmigo'])->name('busqueda.amigo');
// Mis amigos. Seguir usuario.
Route::post('/seguir/amigo', [UserController::class, 'seguirAmigo'])->name('seguir.amigo');
// Mis amigos. Dejar de seguir usuario.
Route::delete('/dejar/seguir/{amigo}', [UserController::class, 'dejarDeSeguir'])->name('dejar.dejarSeguir');
// Mis amigos. Ver sus críticas.
Route::get('usuario/{usuario}/criticas', [UserController::class, 'usuarioCriticas'])->name('usuario.criticas');
// Mis amigos. Ver sus votaciones.
Route::get('usuario/{usuario}/votaciones', [UserController::class, 'usuarioVotaciones'])->name('usuario.votaciones');


/* PANEL DE ADMINISTRACIÓN */
Route::middleware(['auth', 'userEsAdmin'])->group(function () {
    // Inicio
    Route::get('admin', [UserController::class, 'adminIndex'])->name('admin.index');

    // Audiovisuales:
    // Index adminitración de audiovisuales
    Route::get('audiovisuales', [AudiovisualController::class, 'adminIndex'])->name('admin.audiovisuales.index');
    // Almacenar audiovisual en base de datos
    Route::post('audiovisuales', [AudiovisualController::class, 'store'])->name('audiovisuales.store');
    // Actualizar audiovisual
    Route::put('/audiovisuales/{audiovisual}', [AudiovisualController::class, 'update'])->name('audiovisuales.update');
    // Eliminar audiovisual
    Route::delete('/audiovisuales/{audiovisual}', [AudiovisualController::class, 'destroy'])->name('audiovisuales.borrar');
    // Actualizar Elenco
    Route::put('/audiovisuales/{audiovisual}/updateBusqueda', [AudiovisualController::class, 'updateBusqueda'])->name('audiovisuales.updateBusqueda');
    // Buscador géneros
    Route::get('/busqueda/genero', [AudiovisualController::class, 'buscarGenero'])->name('busqueda.genero');
    // Buscador compañías
    Route::get('/busqueda/company', [AudiovisualController::class, 'buscarCompany'])->name('busqueda.company');
    // Buscador reparto
    Route::get('/busqueda/reparto', [AudiovisualController::class, 'buscarReparto'])->name('busqueda.reparto');
    // Buscador guionistas
    Route::get('/busqueda/guionista', [AudiovisualController::class, 'buscarGuionista'])->name('busqueda.guionista');
    // Buscador directores de fotografía
    Route::get('/busqueda/fotografia', [AudiovisualController::class, 'buscarFotografia'])->name('busqueda.fotografia');
    // Buscador compositores
    Route::get('/busqueda/compositor', [AudiovisualController::class, 'buscarCompositor'])->name('busqueda.compositor');
    // Buscador directores
    Route::get('/busqueda/director', [AudiovisualController::class, 'buscarDirector'])->name('busqueda.director');
    // Eliminar Elenco y Equipo
    Route::delete('/audiovisuales/{audiovisual}/eliminar-relacion/{tipoRelacion}/{idRelacion}', [AudiovisualController::class, 'eliminarRelacion'])->name('audiovisuales.eliminarRelacion');
    // Eliminar TODO el Elenco y Equipo
    Route::delete('/audiovisuales/{audiovisualId}/eliminar-todo-elenco', [AudiovisualController::class, 'eliminarTodoElenco'])->name('audiovisuales.eliminarTodoElenco');


    // Users:
    Route::resource('users', UserController::class);
    // Index administración de usuarios
    Route::get('users/admin/index', [UserController::class, 'Index'])->name('admin.users.index');
    // Validar o Invalidar a un usuario
    Route::put('/users/{user}/validar', [UserController::class, 'validar'])->name('admin.users.validar');
    // Ver críticas de un usuario específico
    Route::get('ver_criticas/user/{user}', [UserController::class, 'verCriticas'])->name('admin.verCriticas');
    // Eliminar críticas de un usuario específico
    Route::delete('/eliminar_criticas/{usuario_id}/{audiovisual_id}', [UserController::class, 'verCriticasDestroy'])->name('verCriticas.destroy');
    // Actualizar el rol de un usuario específico
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

    // Personas:
    Route::resource('personas', PersonaController::class);
    // Index administración de personas
    Route::get('personas/admin/index', [PersonaController::class, 'Index'])->name('admin.personas.index');

    // Géneros:
    Route::resource('generos', GeneroController::class);
    // Index administración de géneros
    Route::get('generos/admin/index', [GeneroController::class, 'Index'])->name('admin.generos.index');

    // Companies:
    Route::resource('companies', CompanyController::class);
    // Index administración de compañías
    Route::get('companies/admin/index', [CompanyController::class, 'Index'])->name('admin.companies.index');

    // Premios:
    Route::resource('premios', PremioController::class);
    // Index administración de pewmios
    Route::get('premios/admin/index', [PremioController::class, 'Index'])->name('admin.premios.index');
    // Buscador de audiovisual para premios.
    Route::get('/busqueda/audiovisual', [PremioController::class, 'buscarAudiovisual']);
});



/* COOKIE POLÍTICA DE PRIVACIDAD */
Route::get('/privacidad_cookies', function () {
    return view('privacidad_cookies');
})->name('privacidad_cookies');

/* QUIENES SOMOS */
Route::get('/sobre-nosotros', function () {
    return view('sobre-nosotros');
})->name('sobre-nosotros');

/* POLÍTICA DE PRIVACIDAD */
Route::get('/politica-de-privacidad', function () {
    return view('politica-de-privacidad');
})->name('politica-de-privacidad');

require __DIR__ . '/auth.php';
