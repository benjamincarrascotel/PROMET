<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuperAdmin extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'superadmins';

    /*
    public function empresa(){
        return $this->belongsTo('App\Models\Empresas','empresa_id','id');
    }

    public function solicitud(){
        return $this->hasMany('App\Models\Solicitud','jefe_operaciones_id','id');
    }
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'rut',
        'rut_dv',
        'nombre',
        'apellido1',
        'apellido2',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'salt',
        'password'
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
