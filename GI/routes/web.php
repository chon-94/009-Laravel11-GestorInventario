<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController; //para poder usar el el modelo productos


Route::get('/', function () {
    return view('welcome');
});

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
