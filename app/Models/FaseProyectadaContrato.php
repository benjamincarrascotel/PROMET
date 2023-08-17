<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaseProyectadaContrato extends Model
{
    use HasFactory;

    public $table = 'fase_proyectada_contratos';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contrato_id',

        'creado', //0
        'solicitud_de_base', //1
        'envio_bases_primera_revision', //2
        'primera_revision_bases_por_abastecimiento', //3
        'envio_bases_segunda_revision', //4
        'segunda_revision_bases_por_abastecimiento', //5
        'recopilacion_de_informacion', //6
        'invitacion_a_oferentes', //7
        'visita_a_terreno', //8
        'preguntas_y_consultas_proponente', //9
        'respuestas_del_mandante', //10
        'recepcion_de_ofertas_tecnicas_economicas', //11
        'evaluacion_ofertas_tecnicas', //12
        'evaluacion_ofertas_economicas', //13
        'comite_de_inversiones', //14
        'adjudicacion', //15
        'stand_by', //16
        'adjudicacion_directa', //17

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
