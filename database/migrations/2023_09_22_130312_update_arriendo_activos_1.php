<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateArriendoActivos1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('arriendo_activos', function(Blueprint $table){

            $table->dropColumn('cliente_area');

            $table->after('activo_id', function (Blueprint $table){
                $table->integer('proyecto_id')->nullable();
            });

            $table->after('monto', function (Blueprint $table){
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
        Schema::table('arriendo_activos', function(Blueprint $table){
            $table->dropColumn('proyecto_id');
        });
    }
}
