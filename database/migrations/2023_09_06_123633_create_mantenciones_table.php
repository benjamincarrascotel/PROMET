<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenciones', function (Blueprint $table) {
            $table->id();
            $table->integer('activo_id')->nullable();
            $table->integer('costo_mantencion')->nullable();
            $table->string('cotizacion_mantencion')->nullable(); // imagen o doc

            $table->string('fecha_inicio')->nullable();
            $table->string('fecha_termino')->nullable();
            $table->string('rut_proveedor')->nullable();
            $table->string('nombre_proveedor')->nullable();
            $table->string('contacto_proveedor')->nullable();

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
        Schema::dropIfExists('mantenciones');
    }
}
