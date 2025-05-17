<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController; //para poder usar el el modelo productos
use App\Http\Controllers\MovimientoController; //para poder usar el el modelo productos


Route::get('/', function () {
    return view('welcome');
});

// Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}/update', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}/destroy', [ProductoController::class, 'destroy'])->name('productos.destroy');

// Movimientos
Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');
Route::get('/movimientos/create', [MovimientoController::class, 'create'])->name('movimientos.create');
// Route::post('/movimientos', [MovimientoController::class, 'store'])->name('movimientos.store');
// Route::get('/movimientos/{id}', [MovimientoController::class, 'show'])->name('movimientos.show');
// Route::get('/movimientos/{id}/edit', [MovimientoController::class, 'edit'])->name('movimientos.edit');
// Route::put('/movimientos/{id}/update', [MovimientoController::class, 'update'])->name('movimientos.update');
// Route::delete('/movimientos/{id}/destroy', [MovimientoController::class, 'destroy'])->name('movimientos.destroy');

