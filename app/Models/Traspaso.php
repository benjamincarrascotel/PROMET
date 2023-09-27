<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traspaso extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'traspasos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'arriendo_id',
        'fecha_traspaso',
        'monto_anterior',
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
