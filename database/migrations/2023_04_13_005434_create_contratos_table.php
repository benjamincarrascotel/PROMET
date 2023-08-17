<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('clasificacion_id')->nullable();
            $table->string('tipo_contrato_general')->nullable();
            $table->integer('faena_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('centro_id')->nullable();
            $table->integer('servicio_bien_id')->nullable();
            $table->integer('categoria_id')->nullable();
            $table->integer('proveedor_id')->nullable();
            $table->string('contrato_sap')->nullable();
            $table->string('gestionador')->nullable();
            $table->string('usuario')->nullable();
            $table->integer('abastecimiento_user_id')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('estado_contrato')->nullable();
            $table->integer('estatus')->nullable();
            

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
        Schema::dropIfExists('contratos');
    }
}
