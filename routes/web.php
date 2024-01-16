<?php

use App\Http\Controllers\LaptopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login'); /* welcome */
});

/* RUTAS PARA ACCEDER A LOS ARCHIVOS */
Route::resource('/laptops', 'App\Http\Controllers\LaptopController' );

Route::resource('/productos', 'App\Http\Controllers\ProductosController' );


/* Ruta para el metodo search: */
Route::post('/laptops/search', [LaptopController::class, 'search'])->name('laptops.search');
Route::post('/laptops/limpiar', [LaptopController::class, 'limpiarFormulario'])->name('laptops.limpiarFormulario');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dash', function () {
        return view('dash.index');
    })->name('dash');
});

/* group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */
