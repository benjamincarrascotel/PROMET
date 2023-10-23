<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBajaActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baja_activos', function (Blueprint $table) {
            $table->id();
            $table->integer('activo_id')->nullable();
            $table->string('fecha')->nullable();
            $table->integer('proyecto_id')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('archivo1')->nullable();
            $table->string('archivo2')->nullable();
            $table->string('archivo3')->nullable();
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
        Schema::dropIfExists('baja_activos');
    }
}
