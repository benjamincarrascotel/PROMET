<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'proveedores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'rut',
        'rut_dv',

        'giro',
        'natural_organizacion',
        'direccion_com',
        'comuna_com',
        'region_com',
        'email_com',
        'telefono_com',
        'persona_contacto_com',
        'direccion_log',
        'comuna_log',
        'region_log',
        'email_log',
        'telefono_log',
        'persona_contacto_log',
        'nro_cuenta',
        'tipo_cuenta',
        'banco',
        'moneda',
        'email_pago',
        'cheque_checkbox',
        'vale_vista_checkbox',

        'sociedad_a_facturar',
        'nombre_solicitante',
        'cargo_solicitante',
        'departamento_solicitante',
        'jefatura_solicitante',
        'condiciones_pago',
        'tipo_documento',
        'descripcion',
        'fecha_solicitud',



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
