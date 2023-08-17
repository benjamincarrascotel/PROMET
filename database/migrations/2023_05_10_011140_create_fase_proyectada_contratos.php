<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseProyectadaContratos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_proyectada_contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->nullable();

            $table->string('solicitud_de_base')->nullable(); //0
            $table->string('envio_bases_primera_revision')->nullable(); //1
            $table->string('primera_revision_bases_por_abastecimiento')->nullable(); //2
            $table->string('envio_bases_segunda_revision')->nullable(); //3
            $table->string('segunda_revision_bases_por_abastecimiento')->nullable(); //4
            $table->string('recopilacion_de_informacion')->nullable(); //5
            $table->string('invitacion_a_oferentes')->nullable(); //6
            $table->string('visita_a_terreno')->nullable(); //7
            $table->string('preguntas_y_consultas_proponente')->nullable(); //8
            $table->string('respuestas_del_mandante')->nullable(); //9
            $table->string('recepcion_de_ofertas_tecnicas_economicas')->nullable(); //10
            $table->string('evaluacion_ofertas_tecnicas')->nullable(); //11
            $table->string('evaluacion_ofertas_economicas')->nullable(); //12
            $table->string('comite_de_inversiones')->nullable(); //13
            $table->string('adjudicacion')->nullable(); //14
            $table->timestamps();
        });

        Schema::table('contratos', function(Blueprint $table){
            $table->string('fase_proyectada_flag')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_proyectada_contratos');
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropColumn('fase_proyectada_flag');

        });
    }
}
