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
Route::get('/', [AudiovisualController::class, 'index'])->name('home.index')->middleware('ValidadoMiddleware');


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
Route::post('/votaciones/show', [VotacionController::class, 'show'])->name('votaciones.show');
// Ver crítica del audiovisual.
Route::get('audivisual/criticas/{audiovisual}', [AudiovisualController::class, 'criticas'])->name('ver.criticas');
// Crear crítica del audiovisual.
Route::post('criticas/create/{audiovisual}', [CriticaController::class, 'store'])->name('criticas.store');
// Seguimiento asíncrono
Route::post('/seguimiento/toggle', [UserController::class, 'toggleSeguimiento'])->name('toggle.seguimiento');


/* MENÚ DE USUARIO */
// Mis votaciones.
Route::get('mis_votaciones', [UserController::class, 'misVotaciones'])->name('votaciones.index');
// Mis críticas.
Route::get('mis_criticas', [UserController::class, 'miscriticas'])->name('users.criticas');
// Mis críticas, editar.
Route::put('/criticas/edit/{usuario_id}/{audiovisual_id}', [CriticaController::class, 'update'])->name('criticas.update');
// Mis críticas, borrar.
Route::delete('/criticas/{usuario_id}/{audiovisual_id}', [CriticaController::class, 'destroy'])->name('criticas.destroy');
// Mis amigos.
Route::get('amigos', [UserController::class, 'misAmigos'])->name('amigos.index');
// Mis seguimientos de audiovisuales.
Route::get('seguimientos', [UserController::class, 'seguimientos'])->name('seguimientos.index');


/* PANEL DE ADMINISTRACIÓN */
Route::middleware(['auth', 'userEsAdmin'])->group(function () {
    // Inicio
    Route::get('admin', [UserController::class, 'adminIndex'])->name('admin.index');

    //Audiovisuales:
    Route::get('audiovisuales', [AudiovisualController::class, 'adminIndex'])->name('admin.audiovisuales.index');
    Route::get('audiovisuales/create', [AudiovisualController::class, 'create'])->name('audiovisuales.create');
    Route::post('audiovisuales', [AudiovisualController::class, 'store'])->name('audiovisuales.store');
    Route::get('/audiovisuales/{audiovisual}', [AudiovisualController::class, 'adminShow'])->name('admin.audiovisuales.show');
    Route::get('/audiovisuales/{audiovisual}/editar', [AudiovisualController::class, 'edit'])->name('audiovisuales.edit');
    Route::put('/audiovisuales/{audiovisual}', [AudiovisualController::class, 'update'])->name('audiovisuales.update');
    Route::delete('/audiovisuales/{audiovisual}', [AudiovisualController::class, 'destroy'])->name('audiovisuales.borrar');
    Route::put('/audiovisuales/{audiovisual}/updateBusqueda', [AudiovisualController::class, 'updateBusqueda'])->name('audiovisuales.updateBusqueda');
    Route::get('/busqueda/genero', [AudiovisualController::class, 'buscarGenero'])->name('busqueda.genero');
    Route::get('/busqueda/company', [AudiovisualController::class, 'buscarCompany'])->name('busqueda.company');
    Route::get('/busqueda/reparto', [AudiovisualController::class, 'buscarReparto'])->name('busqueda.reparto');
    Route::get('/busqueda/guionista', [AudiovisualController::class, 'buscarGuionista'])->name('busqueda.guionista');
    Route::get('/busqueda/fotografia', [AudiovisualController::class, 'buscarFotografia'])->name('busqueda.fotografia');
    Route::get('/busqueda/compositor', [AudiovisualController::class, 'buscarCompositor'])->name('busqueda.compositor');
    Route::get('/busqueda/director', [AudiovisualController::class, 'buscarDirector'])->name('busqueda.director');
    Route::delete('/audiovisuales/{audiovisual}/eliminar-genero/{genero}', [AudiovisualController::class, 'eliminarGenero'])->name('audiovisuales.eliminarGenero');
    Route::delete('/audiovisuales/{audiovisual}/eliminar-compania/{company}', [AudiovisualController::class, 'eliminarCompania'])->name('audiovisuales.eliminarCompania');
    Route::delete('/audiovisuales/{audiovisual}/eliminar-director/{director}', [AudiovisualController::class, 'eliminarDirector'])->name('audiovisuales.eliminarDirector');
    Route::delete('/audiovisuales/{audiovisual}/eliminar-compositor/{compositor}', [AudiovisualController::class, 'eliminarCompositor'])->name('audiovisuales.eliminarCompositor');
    Route::delete('/audiovisuales/{audiovisual}/eliminar-fotografia/{fotografia}', [AudiovisualController::class, 'eliminarFotografia'])->name('audiovisuales.eliminarFotografia');
    Route::delete('/audiovisuales/{audiovisual}/eliminar-guionista/{guionista}', [AudiovisualController::class, 'eliminarGuionista'])->name('audiovisuales.eliminarGuionista');
    Route::delete('/audiovisuales/{audiovisual}/eliminar-reparto/{reparto}', [AudiovisualController::class, 'eliminarReparto'])->name('audiovisuales.eliminarReparto');

    // Users:
    Route::resource('users', UserController::class);
    Route::get('users/admin/index', [UserController::class, 'Index'])->name('admin.users.index');
    Route::put('/users/{user}/validar', [UserController::class, 'validar'])->name('admin.users.validar');
    Route::get('ver_criticas/user/{user}', [UserController::class, 'verCriticas'])->name('admin.verCriticas');
    Route::delete('/eliminar_criticas/{usuario_id}/{audiovisual_id}', [UserController::class, 'verCriticasDestroy'])->name('verCriticas.destroy');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

    // Personas:
    Route::resource('personas', PersonaController::class);
    Route::get('personas/admin/index', [PersonaController::class, 'Index'])->name('admin.personas.index');

    // Géneros:
    Route::resource('generos', GeneroController::class);
    Route::get('generos/admin/index', [GeneroController::class, 'Index'])->name('admin.generos.index');

    // Companies:
    Route::resource('companies', CompanyController::class);
    Route::get('companies/admin/index', [CompanyController::class, 'Index'])->name('admin.companies.index');

    // Premios:
    Route::resource('premios', PremioController::class);
    Route::get('premios/admin/index', [PremioController::class, 'Index'])->name('admin.premios.index');
    Route::get('/busqueda/audiovisual', [PremioController::class, 'buscarAudiovisual']);
});


/* POLITICA DE PRIVACIDAD Y QUIENES SOMOS */
Route::get('/politica-de-privacidad', function () {
    return view('politica-de-privacidad');
})->name('politica-de-privacidad');

Route::get('/privacidad_cookies', function () {
    return view('privacidad_cookies');
})->name('privacidad_cookies');

Route::get('/sobre-nosotros', function () {
    return view('sobre-nosotros');
})->name('sobre-nosotros');

require __DIR__ . '/auth.php';
