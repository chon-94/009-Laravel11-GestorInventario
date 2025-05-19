@extends('layouts/main')

    <main class="mt-20 mb-1">
        <div class="container mx-auto px-4">

            <!-- Tabla de inventario (Solo lectura) -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden mb-6">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Inventario Actual</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Origen</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Stock</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Precio Compra</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Precio Venta</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Perecedero</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Detalles</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($productos as $producto)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-white">{{ $producto->nombre }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-white">{{ $producto->origen }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $producto->stock }} {{ $producto->unidad }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">${{ number_format($producto->compra ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">${{ number_format($producto->venta ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $producto->es_perecedero ? 'Sí' : 'No' }}
                                        @if ($producto->es_perecedero)
                                            - {{ $producto->fecha_caducidad }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                        {{ Str::limit($producto->descripcion, 30) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                                        No hay productos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $productos->links() }}
                </div>
            </div>

            <!-- Formulario de movimiento -->
            <div class="max-w-2xl mx-auto w-full">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Nuevo Movimiento</h2>

                    {{-- <form action="{{ route('movimientos.store') }}" method="POST">
                        @csrf --}}

                        <!-- Producto + Tipo -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Campo Producto -->
                            <div>
                                <label for="producto_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Producto*</label>
                                <select name="producto_id" id="producto_id" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Producto</option>
                                    @foreach ($productosCombo as $producto)
                                        <option value="{{ $producto->id }}" data-unidad="{{ $producto->unidad }}">
                                            {{ $producto->nombre }} - Stock: {{ $producto->stock }} {{ $producto->unidad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Campo Tipo -->
                            <div>
                                <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de movimiento*</label>
                                <select name="tipo" id="tipo" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Movimiento</option>
                                    <option value="venta">Venta</option>
                                    <option value="reponer">Reposición</option>
                                </select>
                            </div>
                        </div>

                        <!-- Unidad de venta + Cantidad -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Campo Unidad_venta -->
                            <div>
                                <label for="unidad_venta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unidad de venta*</label>
                                <select name="unidad_venta" id="unidad_venta" required
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Unidad</option>
                                    @php
                                        $unidades = App\Models\Movimiento::unidadesPermitidas();
                                    @endphp
                                    @foreach ($unidades as $u)
                                        <option value="{{ $u }}">{{ ucfirst($u) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Campo Cantidad -->
                            <div>
                                <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cantidad*</label>
                                <input type="number" step="0.01" min="0.01"
                                       name="cantidad" id="cantidad" required
                                       placeholder="0.00"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>

                        <!-- Descripción (ocupa las dos columnas en pantallas medianas y más grandes) -->
                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea id="descripcion" name="descripcion" placeholder="Comentarios" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>

                        <!-- Botón submit -->
                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                Registrar Movimiento
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <!-- Script para filtrar unidades según producto seleccionado -->
