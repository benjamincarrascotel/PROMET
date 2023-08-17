<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleContrato extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'detalle_contratos';

    public function tipo_contrato(){
        return $this->belongsTo('App\Models\TipoContrato','tipo_contrato_id','id');
    }
    public function accion_contrato(){
        return $this->belongsTo('App\Models\AccionContrato','accion_id','id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contrato_id',
        'gasto_anual',
        'fecha_inicio',
        'fecha_termino',
        'facturacion_mensual',
        'monto_factible',
        'puntos_FM',
        'dotacion',
        'puntos_DOT',
        'interferencia_ops',
        'puntos_interf',
        'duracion',
        'puntos_duracion',
        'tipo_contrato_id',
        'puntos_tipo_contrato',
        'porcentaje_1',
        'riesgo_negocio',
        'criticidad_ops',
        'criticidad_personas',
        'cantidad_areas_invo',
        'porcentaje_2',
        'transversal',
        'accion_id',
        'kpi',
        'polinomio',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'fecha_inicio' => 'datetime:Y-m-d',
        'fecha_termino' => 'datetime:Y-m-d',


        // 'fecha' => 'datetime:Y-m-d H:i:s'
    ];
}
