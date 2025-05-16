@extends('layouts/main')
<!-- Extiende un layout principal común -->
<!-- Esto permite reutilizar estructuras como header, footer, menú lateral, etc. -->

@section('contenido')
    <main class="mt-20 mb-1">
        <div class="container mx-auto px-4">

            <!-- Título -->
            <h1 class="text-2xl font-bold mb-6">Detalle del Producto</h1>

            <!-- Tarjeta contenedora -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

                <!-- Encabezado -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ $producto->nombre }} - ID: {{ $producto->id }}
                    </h2>
                </div>

                <div class="p-6 md:flex md:space-x-6">

                    <!-- Columna izquierda - Datos principales -->
                    <div class="md:w-1/2 space-y-4">
                
                        <!-- ID -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">ID</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $producto->id }}</span>
                        </div>
                
                        <!-- Nombre -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $producto->nombre }}</span>
                        </div>
                
                        <!-- Origen -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Origen</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $producto->origen }}</span>
                        </div>
                
                        <!-- Unidad -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Unidad</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $producto->unidad }}</span>
                        </div>
                
                        <!-- Stock -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Stock</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $producto->stock }}</span>
                        </div>
                
                        <!-- Precio Compra -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Precio Compra</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">${{ number_format($producto->compra ?? 0, 2) }}</span>
                        </div>
                
                        <!-- Precio Venta -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Precio Venta</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">${{ number_format($producto->venta ?? 0, 2) }}</span>
                        </div>
                
                        <!-- Es Perecedero -->
                        <div class="flex items-center justify-between">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Es Perecedero</span>
                            <span class="font-semibold text-gray-800 dark:text-gray-200">
                                {{ $producto->es_perecedero ? 'Sí' : 'No' }}
                            </span>
                        </div>
                
                        <!-- Fecha Caducidad -->
                        @if ($producto->es_perecedero)
                            <div class="flex items-center justify-between">
                                <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Caducidad</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $producto->fecha_caducidad ?? '—' }}
                                </span>
                            </div>
                        @endif
                
                    </div>
                
                    <!-- Columna derecha - Descripción -->
                    <div class="md:w-1/2 pt-2 mt-4 md:mt-0">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Descripción</span>
                            @if ($producto->descripcion)
                                <p class="italic text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $producto->descripcion }}
                                </p>
                            @else
                                <p class="italic text-gray-400 dark:text-gray-500">Sin descripción</p>
                            @endif
                        </div>
                    </div>
                
                </div>
                </div>

                <!-- Botones de acción -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">

                <!-- Botón Volver -->
                        <a href="{{ route('productos.index') }}" 
                            class="flex items-center justify-center w-32 h-10 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                            </a>

                    <!-- Botón Editar -->
                    <a href="{{ route('productos.edit', $producto->id) }}" 
                       class="flex items-center justify-center w-32 h-10 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="flex items-center justify-center w-32 h-10 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection