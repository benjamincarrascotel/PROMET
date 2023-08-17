<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseContratoComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_contrato_comprobantes', function (Blueprint $table) {
            $table->id();

            $table->integer('contrato_id')->nullable();

            $table->string('creado')->nullable(); //0
            $table->string('solicitud_de_base')->nullable(); //1
            $table->string('envio_bases_primera_revision')->nullable(); //2
            $table->string('primera_revision_bases_por_abastecimiento')->nullable(); //3
            $table->string('envio_bases_segunda_revision')->nullable(); //4
            $table->string('segunda_revision_bases_por_abastecimiento')->nullable(); //5
            $table->string('recopilacion_de_informacion')->nullable(); //6
            $table->string('invitacion_a_oferentes')->nullable(); //7
            $table->string('visita_a_terreno')->nullable(); //8
            $table->string('preguntas_y_consultas_proponente')->nullable(); //9
            $table->string('respuestas_del_mandante')->nullable(); //10
            $table->string('recepcion_de_ofertas_tecnicas_economicas')->nullable(); //11
            $table->string('evaluacion_ofertas_tecnicas')->nullable(); //12
            $table->string('evaluacion_ofertas_economicas')->nullable(); //13
            $table->string('comite_de_inversiones')->nullable(); //14
            $table->string('adjudicacion')->nullable(); //15
            $table->string('stand_by')->nullable(); //16
            $table->string('adjudicacion_directa')->nullable(); //17

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_contrato_comprobantes');
    }
}
