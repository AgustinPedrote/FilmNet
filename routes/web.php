<?php

use App\Http\Controllers\AudiovisualController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CriticaController;
use App\Http\Controllers\VotacionController;
use App\Models\Audiovisual;
use App\Models\Critica;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//rutas

//Peliculas: separa las rutas por secciones.
Route::get('/', [AudiovisualController::class, 'index'])->name('home.index');
Route::get('/audiovisual/{audiovisual}', [AudiovisualController::class, 'show'])->name('audiovisual.show');
Route::get('peliculas', [AudiovisualController::class, 'peliculasIndex'])->name('peliculas.index');
Route::get('series', [AudiovisualController::class, 'seriesIndex'])->name('series.index');
Route::get('documentales', [AudiovisualController::class, 'documentalesIndex'])->name('documentales.index');

//Rutas logueado.
Route::get('mis_votaciones', [UserController::class, 'misVotaciones'])->name('votaciones.index');

Route::get('mis_criticas', [UserController::class, 'miscriticas'])->name('users.criticas');
Route::get('audivisual/criticas/{audiovisual}', [AudiovisualController::class, 'criticas'])->name('ver.criticas');
Route::post('criticas/create/{audiovisual}', [CriticaController::class, 'store'])->name('criticas.store');
Route::delete('/criticas/{usuario_id}/{audiovisual_id}', [CriticaController::class, 'destroy'])->name('criticas.destroy');
Route::put('/criticas/edit/{usuario_id}/{audiovisual_id}', [CriticaController::class, 'update'])->name('criticas.update');

Route::get('amigos', [UserController::class, 'misAmigos'])->name('amigos.index');

Route::post('votaciones/create/{audiovisual}', [VotacionController::class, 'store'])->name('votaciones.store');

Route::get('seguimientos', [UserController::class, 'seguimientos'])->name('seguimientos.index');
Route::post('seguimientos/create/{audiovisual}', [UserController::class, 'insertSeguimiento'])->name('insert.seguimiento');
Route::delete('/seguimiento/{audiovisual}', [UserController::class, 'quitarSeguimiento'])->name('quitar.seguimiento');


/* POLITICA DE PRIVACIDAD Y QUIENES SOMOS */
Route::get('/politica-de-privacidad', function () {
    return view('politica-de-privacidad');
})->name('politica-de-privacidad');

Route::get('/sobre-nosotros', function () {
    return view('sobre-nosotros');
})->name('sobre-nosotros');


//Ruta para admin

Route::middleware(['auth', 'userEsAdmin'])->group(function () {

    //Ruta index del panel de administración:
    Route::get('admin', [UserController::class, 'adminIndex'])->name('admin.index');

    //Rutas audiovisuales de admin:
    Route::get('audiovisuales', [AudiovisualController::class, 'adminIndex'])->name('admin.audiovisual.index');
    Route::get('audiovisuales/create', [AudiovisualController::class, 'create'])->name('audiovisual.create');
    Route::post('audiovisuales', [AudiovisualController::class, 'store'])->name('audiovisuales.store');
    Route::get('/audiovisuales/{audiovisual}', [AudiovisualController::class, 'adminShow'])->name('admin.audiovisual.show');
    Route::get('/audiovisuales/editar/{audiovisual}', [AudiovisualController::class, 'edit'])->name('audiovisual.edit');
    Route::put('/audiovisuales/update/{audiovisual}', [AudiovisualController::class, 'update'])->name('audiovisual.update');
    Route::delete('/audiovisuales/borrar/{audiovisual}', [AudiovisualController::class, 'destroy'])->name('audiovisual.borrar');

    //Rutas de usuarios de admin:
});



require __DIR__ . '/auth.php';
