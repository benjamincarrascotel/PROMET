<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'ventas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activo_id',
        'precio_venta',
        'cotizacion_venta',
        'fecha_venta',

        'rut_cliente',
        'nombre_cliente',
        'contacto_cliente',   
        'estado', 

        'comprobante_termino', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',

        // 'fecha' => 'datetime:Y-m-d H:i:s'
    ];
}
