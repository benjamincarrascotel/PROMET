<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activo extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'activos';

    public function sub_familia(){
        return $this->belongsTo('App\Models\SubFamiliaProducto','sub_familia_id','id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub_familia_id',
        'marca',
        'modelo',
        'año',
        'clasificacion',
        'codigo_interno',
        'numero_serie',
        'horas_uso_promedio',
        'precio_compra',
        'orden_compra',
        'vida_util',
        'valor_residual',
        'foto',
        'codigo_qr',
        'estado',

        'tiempo_uso_meses',
        'centro_costos',
        'tipo_moneda',
        'archivo',
        'archivo2',
        'archivo3',

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
