<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('activo_id')->nullable();
            $table->integer('costo_venta')->nullable();
            $table->string('cotizacion_venta')->nullable(); // imagen o doc

            $table->string('fecha_venta')->nullable();
            $table->string('rut_cliente')->nullable();
            $table->string('nombre_cliente')->nullable();
            $table->string('contacto_cliente')->nullable();
            $table->string('estado')->nullable();
            $table->string('comprobante_termino')->nullable();


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
        Schema::dropIfExists('ventas');
    }
}
