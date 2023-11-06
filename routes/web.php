<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorArticuloController;
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
    return view('welcome');
});

//Route::resource('/autorarticulo', AutorArticuloController::class);
Route::get('/', [AutorArticuloController::class, 'index'])->name('indexAutorArticulo');


Route::middleware(['web'])->group(function () {
    Route::post('/filtrarFechas', [AutorArticuloController::class, 'filtro'])->name('filtrarFechas');
    Route::get('/crearAutorArticulo', [AutorArticuloController::class, 'create'])->name('crearAutorArticulo');
    Route::post('/storeAutorarticulo', [AutorArticuloController::class, 'store'])->name('storeAutorArticulo');
});


Route::post('/autorarticulo', [AutorArticuloController::class, 'storeConsumible']);

Route::get('/get-csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});



