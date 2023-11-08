<?php

use App\Http\Controllers\AudiovisualController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//rutas

//Peliculas: serapa las rutas por secciones.

Route::get('peliculas', [AudiovisualController::class, 'peliculasIndex'])->name('peliculas.index');
Route::get('series', [AudiovisualController::class, 'seriesIndex'])->name('series.index');
Route::get('documentales', [AudiovisualController::class, 'documentalesIndex'])->name('documentales.index');



require __DIR__.'/auth.php';
