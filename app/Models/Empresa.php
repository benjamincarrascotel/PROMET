<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'empresas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'rut',
        'giro',
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
