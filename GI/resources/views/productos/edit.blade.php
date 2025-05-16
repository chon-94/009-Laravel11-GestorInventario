@extends('layouts/main')
<!-- Extiende un layout principal común (por ejemplo, layouts/main.blade.php) -->
<!-- Esto permite reutilizar estructuras como header, footer, menú lateral, etc. -->

<main class="mt-20 mb-1">
    <!-- Contenedor principal con margen superior e inferior -->

    <div class="container mx-auto px-4">
        <!-- Contenedor centralizado con padding horizontal -->

        <h1 class="text-2xl font-bold mb-6">Editar</h1>
        <!-- Título de la página -->

        <!-- Tarjeta contenedora del formulario -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

            <!-- Encabezado de la tarjeta -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Editor  de productors ID: {{ $producto->id }}</h2>
            </div>

            <!-- Cuerpo del formulario -->
            <div class="p-6">
                <!-- Formulario para crear un producto -->
                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT') 


                    <!-- Diseño en grid: 1 columna en móvil, 2 en pantallas medianas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Campo Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre*</label>
                            {{-- <input type="text" id="nombre" name="nombre" required
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"> --}}
                            <input type="text" id="nombre" name="nombre" required
                                   value="{{ old('nombre', $producto->nombre) }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

  <!-- Origen -->
  <div>
    <label for="origen" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Origen*</label>
    <select id="origen" name="origen" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
        <option value="Fabricado" {{ $producto->origen == 'Fabricado' ? 'selected' : '' }}>Fabricado</option>
        <option value="Adquirido" {{ $producto->origen == 'Adquirido' ? 'selected' : '' }}>Adquirido</option>
    </select>
</div>

<!-- Unidad -->
<div>
    <label for="unidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unidad*</label>
    <select id="unidad" name="unidad" required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
        <option value="kilogramos" {{ $producto->unidad == 'kilogramos' ? 'selected' : '' }}>Kilogramos</option>
        <option value="gramos" {{ $producto->unidad == 'gramos' ? 'selected' : '' }}>Gramos</option>
        <option value="litros" {{ $producto->unidad == 'litros' ? 'selected' : '' }}>Litros</option>
        <option value="mililitros" {{ $producto->unidad == 'mililitros' ? 'selected' : '' }}>Mililitros</option>
        <option value="centimetro" {{ $producto->unidad == 'centimetro' ? 'selected' : '' }}>centimetro</option>
        <option value="metro" {{ $producto->unidad == 'metro' ? 'selected' : '' }}>metro</option>
        <option value="unidad" {{ $producto->unidad == 'unidad' ? 'selected' : '' }}>Unidad</option>
    </select>
</div>

<!-- Stock -->
<div>
    <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stock*</label>
    <input type="number" id="stock" name="stock" required min="0" step="0.01"
           value="{{ old('stock', $producto->stock) }}"
           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
</div>

<!-- Compra -->
<div>
    <label for="compra" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Compra*</label>
    <input type="number" id="compra" name="compra" required min="0" step="0.01"
           value="{{ old('compra', $producto->compra) }}"
           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
</div>

<!-- Venta -->

                          <!-- Venta -->
                          <div>
                            <label for="venta" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Precio Venta*</label>
                            <input type="number" id="venta" name="venta" required min="0" step="0.01"
                                   value="{{ old('venta', $producto->venta) }}"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Es Perecedero -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Es Perecedero</label>
                            <div class="mt-1">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="es_perecedero" value="1"
                                           {{ $producto->es_perecedero ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Sí</span>
                                </label>
                            </div>
                        </div>


                            <!-- Fecha Caducidad -->
                            <div id="fecha-caducidad-container" style="{{ $producto->es_perecedero ? 'display: block;' : 'display: none;' }}">
                                <label for="fecha_caducidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fecha Caducidad</label>
                                <input type="date" id="fecha_caducidad" name="fecha_caducidad"
                                       value="{{ old('fecha_caducidad', $producto->fecha_caducidad) }}"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                                <textarea id="descripcion" name="descripcion" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <!-- Botón Cancelar -->
                        <a href="{{ route('productos.index') }}" 
                           class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancelar
                        </a>

                        <!-- Botón Guardar -->
                        <button type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Script para mostrar/ocultar el campo de fecha de caducidad -->
<script>
    // Detectamos cambios en el checkbox "es_perecedero"
    document.querySelector('input[name="es_perecedero"]').addEventListener('change', function() {
        const fechaContainer = document.getElementById('fecha-caducidad-container');
        // Mostramos u ocultamos el campo según si el checkbox está marcado
        fechaContainer.style.display = this.checked ? 'block' : 'none';
    });
</script>