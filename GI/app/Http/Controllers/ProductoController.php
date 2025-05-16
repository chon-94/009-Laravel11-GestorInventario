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
        return view('productos.create');
    }

    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'required|in:kilogramos,gramos,litros,mililitros,unidad',
            'stock' => 'required|numeric|min:0',
            'compra' => 'nullable|numeric|min:0',
            'venta' => 'nullable|numeric|min:0',
            'es_perecedero' => 'boolean',
            'fecha_caducidad' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);
    
        // Guardar el producto
        Producto::create([
            'nombre' => $request->nombre,
            'origen' => $request->origen ?? 'Fabricado',
            'unidad' => $request->unidad,
            'stock' => $request->stock,
            'compra' => $request->compra,
            'venta' => $request->venta,
            'es_perecedero' => $request->es_perecedero ? true : false,
            'fecha_caducidad' => $request->fecha_caducidad,
            'descripcion' => $request->descripcion,
        ]);
    
        // Redirigir con mensaje
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id); // Utiliza findOrFail para manejar el caso en que el producto no existe
        return view('productos.show', compact('producto'));
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
