<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraspasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traspasos', function (Blueprint $table) {
            $table->id();
            $table->integer('arriendo_id')->nullable();
            $table->integer('proyecto_anterior_id')->nullable();
            $table->integer('proyecto_actual_id')->nullable();
            $table->integer('monto_anterior')->nullable();
            $table->string('tipo_moneda_anterior')->nullable();
            $table->string('fecha_traspaso')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traspasos');
    }
}
