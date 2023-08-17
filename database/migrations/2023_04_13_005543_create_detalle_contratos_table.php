<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->nullable();
            $table->integer('gasto_anual')->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_termino')->nullable();
            $table->integer('facturacion_mensual')->nullable();
            $table->integer('monto_factible')->nullable();
            $table->integer('puntos_FM')->nullable();
            $table->integer('dotacion')->nullable();
            $table->integer('puntos_DOT')->nullable();
            $table->string('interferencia_ops')->nullable();
            $table->integer('puntos_interf')->nullable();
            $table->integer('duracion')->nullable();
            $table->integer('puntos_duracion')->nullable();
            $table->integer('tipo_contrato_id')->nullable();
            $table->integer('puntos_tipo_contrato')->nullable();
            $table->float('porcentaje_1')->nullable();
            $table->integer('riesgo_negocio')->nullable();
            $table->integer('criticidad_ops')->nullable();
            $table->integer('criticidad_personas')->nullable();
            $table->integer('cantidad_areas_invo')->nullable();
            $table->float('porcentaje_2')->nullable();
            $table->string('transversal')->nullable();
            $table->integer('accion_id')->nullable();
            $table->boolean('kpi')->nullable();
            $table->boolean('polinomio')->nullable();
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
        Schema::dropIfExists('detalle_contratos');
    }
}
