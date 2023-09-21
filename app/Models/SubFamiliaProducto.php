<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubFamiliaProducto extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'sub_familia_productos';

    public function familia(){
        return $this->belongsTo('App\Models\FamiliaProducto','familia_id','id');
    }

    protected $fillable = [
        'familia_id',
        'nombre',
        'acronimo'

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        // 'fecha' => 'datetime:Y-m-d H:i:s'
    ];

}
