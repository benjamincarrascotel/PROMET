<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrazabilidadContratosTable extends Migration
{
    //TODO eliminar tabla

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trazabilidad_contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->nullable();
            $table->string('enero')->nullable();
            $table->string('febrero')->nullable();
            $table->string('marzo')->nullable();
            $table->string('abril')->nullable();
            $table->string('mayo')->nullable();
            $table->string('junio')->nullable();
            $table->string('julio')->nullable();
            $table->string('agosto')->nullable();
            $table->string('septiembre')->nullable();
            $table->string('octubre')->nullable();
            $table->string('noviembre')->nullable();
            $table->string('diciembre')->nullable();

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
        Schema::dropIfExists('trazabilidad_contratos');
    }
}
