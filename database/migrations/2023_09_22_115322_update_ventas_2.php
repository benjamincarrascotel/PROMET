<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVentas2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ventas', function(Blueprint $table){

            $table->dropColumn('rut_cliente');
            $table->dropColumn('nombre_cliente');

            $table->after('fecha_venta', function (Blueprint $table){
                $table->integer('proyecto_id')->nullable();
            });

            $table->after('precio_venta', function (Blueprint $table){
                $table->string('tipo_moneda')->nullable();
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
        Schema::table('ventas', function(Blueprint $table){
            $table->dropColumn('proyecto_id');
        });
    }
}
