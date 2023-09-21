<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamiliaProducto extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'familia_productos';

    protected $fillable = [
        'nombre',
        'acronimo'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        // 'fecha' => 'datetime:Y-m-d H:i:s'
    ];
}
