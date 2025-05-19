<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;

use App\Models\Producto;

class MovimientoController extends Controller
{
    public function index()
    {
        return view('movimientos.index');// Retorna la vista 'movimientos.index' pasando los movimientos como variable
    }

    public function create()
    {
    // $productos = Producto::all();
    $productos = Producto::paginate(4);    

    $productosCombo = Producto::all();
    return view('movimientos.create', compact('productos', 'productosCombo'));

    }

    public function store(Request $request)
    {
        //
    }

    public function show(Movimiento $movimiento)
    {
        //
    }

    public function edit(Movimiento $movimiento)
    {
        //
    }

    public function update(Request $request, Movimiento $movimiento)
    {
        //
    }

    public function destroy(Movimiento $movimiento)
    {
        //
    }
}
