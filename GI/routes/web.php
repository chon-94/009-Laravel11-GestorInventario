<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController; //para poder usar el el modelo productos


Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');