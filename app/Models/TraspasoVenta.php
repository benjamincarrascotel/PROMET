<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TraspasoVenta extends Model
{
    use HasFactory;
    //use SoftDeletes;

    public $table = 'traspaso_ventas';

    public function anterior(){
        return $this->belongsTo('App\Models\Proyecto','proyecto_anterior_id','id');
    }

    public function actual(){
        return $this->belongsTo('App\Models\Proyecto','proyecto_actual_id','id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'proceso_cambio_flag',
        'proceso_anterior_id',
        'venta_id',
        'fecha_traspaso',
        'precio_venta_anterior',
        'tipo_moneda_anterior',
        'proyecto_anterior_id',
        'proyecto_actual_id',

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
