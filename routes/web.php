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

Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('home');
Route::get('/catalogo', [\App\Http\Controllers\FrontendController::class, 'catalogo'])->name('catalogo');
Route::get('/about', [\App\Http\Controllers\FrontendController::class, 'about'])->name('about');
Route::get('/producto/{id}', [\App\Http\Controllers\FrontendController::class, 'show'])->name('producto.show');
Route::post('/carrito/agregar/{id}', [\App\Http\Controllers\FrontendController::class, 'agregarCarrito'])->name('carrito.add');
Route::get('/carrito', [\App\Http\Controllers\FrontendController::class, 'carrito'])->name('carrito.index');
Route::post('/carrito/eliminar/{id}', [\App\Http\Controllers\FrontendController::class, 'eliminarCarrito'])->name('carrito.remove');
Route::post('/carrito/actualizar/{id}', [\App\Http\Controllers\FrontendController::class, 'actualizarCarrito'])->name('carrito.update');

// Checkout routes
Route::get('/checkout', [\App\Http\Controllers\FrontendController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout/pagar', [\App\Http\Controllers\FrontendController::class, 'procesarPago'])->name('checkout.pay');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    Route::resource('categorias', \App\Http\Controllers\Admin\CategoriaController::class);
    Route::resource('marcas', \App\Http\Controllers\Admin\MarcaController::class);
    Route::resource('variedades', \App\Http\Controllers\Admin\VariedadController::class);
    Route::resource('productos', \App\Http\Controllers\Admin\ProductoController::class);
});
