<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArriendoActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arriendo_activos', function (Blueprint $table) {
            $table->id();
            $table->integer('activo_id')->nullable();
            $table->integer('monto')->nullable();
            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_termino')->nullable();
            $table->string('cliente_area')->nullable();
            $table->string('encargado')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('arriendo_activos');
    }
}
