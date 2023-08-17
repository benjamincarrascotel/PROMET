<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'contratos';

    public function clasificacion(){
        return $this->belongsTo('App\Models\Clasificacion','clasificacion_id','id');
    }
    public function faena(){
        return $this->belongsTo('App\Models\Faena','faena_id','id');
    }
    public function area(){
        return $this->belongsTo('App\Models\Area','area_id','id');
    }
    public function centro(){
        return $this->belongsTo('App\Models\Centro','centro_id','id');
    }
    public function servicio_bien(){
        return $this->belongsTo('App\Models\ServicioBien','servicio_bien_id','id');
    }
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria','categoria_id','id');
    }
    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor','proveedor_id','id');
    }
    public function admin_contrato(){
        return $this->belongsTo('App\Models\AdminContrato','admin_contrato_id','id');
    }
    public function abastecimiento_user(){
        return $this->belongsTo('App\Models\AbastecimientoUser','abastecimiento_user_id','id');
    }
    public function tipo_contrato(){
        return $this->belongsTo('App\Models\TipoContrato','tipo_contrato_id','id');
    }
    public function detalle_contrato(){
        return $this->hasMany('App\Models\DetalleContrato','contrato_id','id');
    }
    public function fase_contrato(){
        return $this->hasMany('App\Models\FaseContrato','contrato_id','id');
    }
    public function fase_contrato_comprobante(){
        return $this->hasMany('App\Models\FaseContratoComprobante','contrato_id','id');
    }
    public function fase_proyectada_contrato(){
        return $this->hasMany('App\Models\FaseProyectadaContrato','contrato_id','id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clasificacion_id',
        'tipo_contrato_general',
        'faena_id',
        'area_id',
        'centro_id',
        'servicio_bien_id',
        'categoria_id',
        'proveedor_id',
        'contrato_sap',
        'admin_contrato_id', 
        'usuario',
        'abastecimiento_user_id',
        'descripcion',
        'estado_contrato',
        'estatus',
        'tipo_renovacion',
        'fase_proyectada_flag',

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
