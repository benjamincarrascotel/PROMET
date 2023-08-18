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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
