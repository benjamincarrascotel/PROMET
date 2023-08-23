<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ArriendoActivo extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'arriendo_activos';

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
        'monto',
        'fecha_inicio',
        'fecha_termino',
        'cliente_area',
        'encargado',
        'estado',
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
