<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // $productos = Producto::paginate(5);
        $productos = Producto::all();
        return view('productos.index', compact('productos'));// Retorna la vista 'productos.index' pasando los productos como variable

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Producto $id)
    {
        //
    }

    public function edit(Producto $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Producto $id)
    {
        //
    }
}
