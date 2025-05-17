<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        return view('movimientos.index');// Retorna la vista 'productos.index' pasando los productos como variable
    }

    public function create()
    {
        //
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
