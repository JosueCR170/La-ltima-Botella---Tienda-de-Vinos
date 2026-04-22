<?php

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
    return view('welcome');
});

// Admin Routes
Route::prefix('admindeVinos')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    Route::resource('categorias', \App\Http\Controllers\Admin\CategoriaController::class);
    Route::resource('marcas', \App\Http\Controllers\Admin\MarcaController::class);
    Route::resource('variedades', \App\Http\Controllers\Admin\VariedadController::class);
    Route::resource('productos', \App\Http\Controllers\Admin\ProductoController::class);
});
