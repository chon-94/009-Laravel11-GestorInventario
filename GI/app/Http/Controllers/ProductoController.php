<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(8);
        // $productos = Producto::all();
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
            'unidad' => 'required|in:kilogramos,gramos,litros,mililitros,centimetro,metro,unidad',
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

    public function edit( $id)
    {
        $producto = Producto::findOrFail($id); // Buscamos manualmente
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los campos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'required|in:kilogramos,gramos,litros,mililitros,centimetro,metro,unidad',
            'stock' => 'required|numeric|min:0',
            'compra' => 'nullable|numeric|min:0',
            'venta' => 'nullable|numeric|min:0',
            'es_perecedero' => 'boolean',
            'fecha_caducidad' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);
    
        // Buscamos el producto por ID
        $producto = Producto::findOrFail($id);
    
        // Actualizamos los datos del producto
        $producto->update([
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
    
        // Redirigimos a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $id)
    {
        try {
            // Eliminamos el producto
            $id->delete();

            // Redirigimos con mensaje de éxito
            return redirect()->route('productos.index')
                             ->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            // En caso de error, mostramos mensaje detallado
            return redirect()->back()
                             ->with('error', 'No se pudo eliminar el producto: ' . $e->getMessage());
        }
    }
}
