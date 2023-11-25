<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorArticuloController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\AutorController;
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
    return redirect()->route('indexArticulo');
});

//Route::resource('/autorarticulo', AutorArticuloController::class);
Route::get('/autorarticulo', [AutorArticuloController::class, 'index'])->name('indexAutorArticulo');
Route::get('/indexExamen', [AutorArticuloController::class, 'indexExamen'])->name('indexExamen');
Route::get('/articulos',[ArticuloController::class, 'index'])->name('indexArticulo');
Route::get('/autores',[AutorController::class, 'index'])->name('indexAutor');
Route::get('/articulosConsumible', [ArticuloController::class, 'articulos'])->name('indexArticuloConsumible');



Route::middleware(['web'])->group(function () {
    Route::post('/filtrarFechas', [AutorArticuloController::class, 'filtro'])->name('filtrarFechas');
    Route::get('/crearAutorArticulo', [AutorArticuloController::class, 'create'])->name('crearAutorArticulo');
    Route::post('/storeAutorarticulo', [AutorArticuloController::class, 'store'])->name('storeAutorArticulo');
    Route::post('/autorarticuloAPI', [AutorArticuloController::class, 'indexConsumible'])->name('indexAutorArticuloConsumible');
    Route::post('/storeAutorArticuloAPI', [AutorArticuloController::class, 'storeConsumible'])->name('storeAutorArticuloConsumible');
    Route::post('/autorarticuloExamenFinal', [AutorArticuloController::class, 'indexExamenFinalConsumible'])->name('indexExamenFinal');
    Route::post('/examenFinalWeb', [AutorArticuloController::class, 'examenFinalWeb'])->name('examenFinalWeb');
});


Route::post('/autorarticulo', [AutorArticuloController::class, 'storeConsumible']);

Route::get('/get-csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});

Route::delete('/deleteArticulo/{id}', [ArticuloController::class, 'destroy'])->name('deleteArticulo');
Route::delete('/deleteArticuloConsumible/{id}', [ArticuloController::class, 'deleteArticulo'])->name('deleteArticuloConsumible');


