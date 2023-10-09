<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVentas3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas', function(Blueprint $table){

            $table->dropColumn('contacto_cliente');
            $table->dropColumn('comprobante_termino');
            $table->dropColumn('cotizacion_venta');

            $table->dropColumn('fecha_venta');

            $table->after('proyecto_id', function (Blueprint $table){
                $table->string('encargado')->nullable();
                $table->string('fecha_inicio')->nullable();
                $table->string('fecha_termino')->nullable();
            });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
