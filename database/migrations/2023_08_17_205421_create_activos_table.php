<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->id();

            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->integer('año')->nullable();
            $table->string('clasificacion')->nullable();
            $table->string('codigo_interno')->nullable();
            $table->string('numero_serie')->nullable();
            $table->integer('horas_uso_promedio')->nullable();

            $table->integer('precio_compra')->nullable();
            $table->string('orden_compra')->nullable();
            $table->integer('vida_util')->nullable();
            $table->integer('valor_residual')->nullable();

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
        Schema::dropIfExists('activos');
    }
}
