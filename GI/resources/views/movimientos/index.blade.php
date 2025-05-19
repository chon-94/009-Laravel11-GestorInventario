@extends('layouts/main')
<!-- Extiende layout principal -->

<main class="mt-20 mb-1">
    <div class="container mx-auto px-4">

        <h1 class="text-2xl font-bold mb-6">Historial de Movimientos</h1>

        <!-- Mensaje de éxito -->
        {{-- @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm">
                {{ session('success') }}
            </div>
        @endif --}}

        <!-- Diseño en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Bloque Ventas Recientes -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Ventas Recientes</h2>
                </div>

                <div class="p-4">
                    {{-- @forelse ($ventas as $movimiento) --}}
                        <div class="flex justify-between items-center py-2 border-b dark:border-gray-700">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">
                                    {{-- {{ $movimiento->cantidad }} {{ $movimiento->unidad_venta }} --}}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{-- {{ $movimiento->producto->nombre }} --}}
                                </p>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{-- {{ $movimiento->fecha }} --}}
                            </span>
                        </div>
                    {{-- @empty --}}
                        <p class="text-sm text-gray-500 dark:text-gray-400 p-4">
                            No hay ventas registradas.
                        </p>
                    {{-- @endforelse --}}
                </div>
            </div>

            <!-- Bloque Reposiciones Recientes -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Reposiciones Recientes</h2>
                </div>

                <div class="p-4">
                    {{-- @forelse ($reponer as $movimiento) --}}
                        <div class="flex justify-between items-center py-2 border-b dark:border-gray-700">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">
                                    {{-- {{ $movimiento->cantidad }} {{ $movimiento->unidad_venta }} --}}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{-- {{ $movimiento->producto->nombre }} --}}
                                </p>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{-- {{ $movimiento->fecha }} --}}
                            </span>
                        </div>
                    {{-- @empty --}}
                        <p class="text-sm text-gray-500 dark:text-gray-400 p-4">
                            No hay reposiciones registradas.
                        </p>
                    {{-- @endforelse --}}
                </div>
            </div>
        
        </div>

        <!-- Botón para registrar nuevo movimiento -->
        <div class="mt-6 flex justify-end">
            {{-- <a href="{{ route('movimientos.create') }}"  --}}
            <a href="{{ route('movimientos.create') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                Registrar Nuevo Movimiento
            </a>
        </div>
        
    </div>
</main>
