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

bueno ahora a agregar lo demas  esta solo es la mitad de mi proyecto

#

# MakeModel Movimiento

     php artisan make:model Movimiento -mcr

# modelado y base de datos

 configuraremos la base de datos y el modelado de movimientos

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
         * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id(); // ID único del movimiento

            // Relación con productos
            $table->foreignId('producto_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Tipo: venta o reposición
            $table->enum('tipo', [
                'venta', 
                'reponer'
            ])->default('venta');

            // Unidad en la que se vendió o reponía
            $table->enum('unidad_venta', [
                'kilogramos', 
                'gramos', 
                'litros', 
                'mililitros', 
                'centimetro', 
                'metro', 
                'unidad'
            ])->default('kilogramos');

            // Cantidad movida
            $table->decimal('cantidad', 8, 2);

            // Fecha del movimiento
            $table->date('fecha')->default(now());

            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
      * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo: Movimiento
 *
 * Este modelo representa un movimiento de stock (venta o reposición)
 * Se usa para:
    * - Registrar cuándo se vende o repone un producto
    * - Guardar la cantidad y unidad usada
    * - Relacionarlo con el modelo Producto
    * - Usarse en reportes de inventario
 */
class Movimiento extends Model
{
    use HasFactory;

    /**
     * Campos que pueden ser asignados masivamente.
     *
     * @var array<string>
     */
    protected $fillable = [
        'producto_id', 
        'tipo', 
        'unidad_venta', 
        'cantidad', 
        'fecha',
    ];

    /**
     * Tipos de datos adicionales
     * Para asegurar formato decimal y fechas
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cantidad' => 'decimal:2',
        'fecha' => 'date',
    ];

    /**
     * Relación: un movimiento pertenece a un producto
     * Devuelve el producto relacionado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(\App\Models\Producto::class);
    }

    /**
     * Devuelve las unidades permitidas para venta/reposición
     * Útil para validaciones y selects dinámicos
     *
     * @return array<string>
     */
    public static function unidadesPermitidas()
    {
        return ['kilogramos', 'gramos', 'litros', 'mililitros', 'centimetro', 'metro', 'unidad'];
    }

    /**
     * Convierte la cantidad a la unidad del almacén
     * Ejemplo: 500 gramos → 0.5 kilogramos (si el producto está en kilogramos)
     *
     * @param string $unidad_venta - Unidad en la que se vendió
     * @param float $cantidad - Cantidad vendida
     * @param string $unidad_almacen - Unidad base del producto
     * @return float - Cantidad convertida a unidad del almacenista
     */
    public static function convertirAUnidadAlmacen($unidad_venta, $cantidad, $unidad_almacen)
    {
        // Definimos cómo convertir entre unidades
        $conversiones = [
            'kilogramos' => [
                'gramos' => 1000,
                'kilogramos' => 1,
            ],
            'litros' => [
                'mililitros' => 1000,
                'litros' => 1,
            ],
            'metro' => [
                'centimetro' => 100,
                'metro' => 1,
            ],
            'unidad' => [
                'unidad' => 1,
            ]
        ];

        // Si hay conversión posible, la hacemos
        if (isset($conversiones[$unidad_almacen][$unidad_venta])) {
            return $cantidad / $conversiones[$unidad_almacen][$unidad_venta];
        }

        // Si no hay conversión, devolvemos la misma cantidad
        return $cantidad;
    }
}

teniendo en cuenta esto ya podriamos empezar con las rutas vistas y controladores

no olvidar las migraciones

php artisan migrate --path=database/migrations/2025_05_16_201706_create_movimientos_table.php


#

#

#

#

#          

#

#

#     

#

#

#     

#

#

#     

#

#

#     
