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
Route::get('/', [AudiovisualController::class, 'index'])->name('home.index');


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
// Seguir audiovisual.
Route::post('seguimientos/create/{audiovisual}', [UserController::class, 'insertSeguimiento'])->name('insert.seguimiento');
// Borrar audiovisual.
Route::delete('/seguimiento/{audiovisual}', [UserController::class, 'quitarSeguimiento'])->name('quitar.seguimiento');


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

    // Users:
    Route::resource('users', UserController::class);

    // Personas:
    Route::resource('personas', PersonaController::class);

    // Géneros:
    Route::resource('generos', GeneroController::class);

    // Companies:
    Route::resource('companies', CompanyController::class);

    // Premios:
    Route::resource('premios', PremioController::class);
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
