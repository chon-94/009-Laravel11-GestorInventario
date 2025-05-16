<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>PROYECTO</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-2x6VZ1YF4M+EZ7V4V1JZ4f6qHeJkK1W7UW2XZ2K1wD2QgMZyqZg0kHQbV7l8W5DjO2zKyojQAk6VFlfYzW0N1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                {!! file_get_contents(public_path('css/tailwind.css')) !!}
            </style>
        @endif
    </head>

    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
    
        {{-- <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen"> --}}
            <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-40">
            
                <!-- Imagen de fondo -->
                <img
                id="background"
                class="fixed -left-20 top-0 opacity-50 z-0 pointer-events-none"
                {{-- class="fixed -left-20 top-0 max-w-[877px] opacity-50 z-0 pointer-events-none" --}}
            
            src="https://laravel.com/assets/img/welcome/background.svg"
            alt="Laravel background" />
        
            <!-- Contenedor fijo para los dos botones -->
            <div class="fixed top-4 right-4 z-50 flex gap-2">
                <!-- Botón para ir a la página welcome -->
                <a href="/" 
                    class="px-2 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                    Welcome
                </a>

                <!-- Botón para alternar modo claro/oscuro -->
                <button id="darkModeToggle" 
                        class="px-2 py-2 rounded-md bg-gray-800 text-white dark:bg-gray-200 dark:text-gray-800 transition flex items-center gap-2">
                    <i class="fa-solid fa-circle-half-stroke"></i>
                    Claro/Oscuro
                </button>
            </div>

            <!-- Contenido principal centrado -->
            @yield('contenido')

            <!-- Scripts -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        </div>  
        
        <!-- Pie de pagina -->
        <footer class="bg-white rounded-lg shadow-sm m-4 text-dark dark:opacity-45 dark:bg-red-800">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>chon.
                </span>
                <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
        </footer>

    </body>

</html>

