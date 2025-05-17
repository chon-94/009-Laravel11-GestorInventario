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
        'descripcion', // Aquí agregamos el campo

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