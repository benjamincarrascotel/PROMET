<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mantencion extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'mantenciones';

    public function activo(){
        return $this->belongsTo('App\Models\Activo','activo_id','id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activo_id',
        'costo_mantencion',
        'tipo_moneda',
        'cotizacion_mantencion',
        'fecha_inicio',
        'fecha_termino',

        'rut_proveedor',
        'nombre_proveedor',
        'contacto_proveedor',   
        'estado', 
        'comprobante_termino', 
        'observaciones',
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
