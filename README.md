# 009-Laravel11-GestorInventario
 Experimentando cosas(de moento)

      composer create-project --prefer-dist laravel/laravel GI "11.*"

en .env

      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=dbcrud09
      DB_USERNAME=root
      DB_PASSWORD=123456

Consola (migracion)

     php artisan migrate

#

## Instalando Breeze en caso requiera en este es innecesario

     php artisan help breeze:install

     php artisan breeze:install --help

     php artisan breeze:install --stack=blade --dark

     php artisan breeze:install blade --dark

# Tailwind

     npm install -D tailwindcss postcss autoprefixer && npx tailwindcss init -p

     npm install && npm run dev

     php artisan migrate

     php artisan serve

#

# Layouts

 hay que explicarlo? bueno aca debemos de crear la carpeta layouts en view y creamos nuestra plantilla y luego welcome lo adaptamos 

#

# DarkMOde

configuramos el boton comentado para que sea dark mode

GI/resources/js/app.js

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('darkModeToggle');
    if (!toggleBtn) return;

    // Verificar si hay preferencia guardada
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    toggleBtn.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');

        // Guardar preferencia
        if (document.documentElement.classList.contains('dark')) {
            localStorage.theme = 'dark';
        } else {
            localStorage.theme = 'light';
        }
    });
});

GI/tailwind.config.js
darkmode:'class',

#

# MakeModel

 ejecutamos

     php artisan make:model Producto -mcr

 se nos crea 3 archivos

 INFO  Model [app/Models/Producto.php] created successfully.  
 INFO  Migration [database/migrations/2025_05_16_023930_create_productos_table.php] created successfully.  
 INFO  Controller [app/Http/Controllers/ProductoController.php] created successfully.     

 entonces nos ponemos a trabajar en el modelado y base de datos 

 cosas a tener en cuenta 

 genera datos falsos paraprobar

     php artisan make:factory ProductoFactory --model=Producto 


 inserta datos iniciales de preuba 

     php artisan make:seeder ProductoSeeder

ahora deberiamos de centrarnos en las vistas rutas y  controles

#

# index

en los controladores

para paginadores y solo mostar una cantidad predeterminada
     $productos = Producto::paginate(5);
para mostarar todo     
     $productos = Producto::all();

en el index
    {{ $productos->links() }} 
    <!-- Mostrar links de paginación -->

# 

# Crear

 a aca empieza los dolores de huevos aveces tenemos problemas por aca ahora no estoy seguro como lo solucione pero lo hice en el controlador
 se que era ahi porque el probleam era el boton 

 debemos de tener en cuenta el controlador de editar para ver la vista y update para poder hacer la actualizazcion asi que serian 2 rutas y 2 cotroladores

     Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
     Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');

 trabajamos en la vista de editary debemos de tener en cuenta esto esto ira en nuestro formulario                
     <form action="{{ route('productos.store') }}" method="POST">
     @csrf
     @method('post') 


#

# Ver
 

#

# Editar

#

# Eliiminar

#

# Detalles

el paginador nos servira aca vere mas info del paginador