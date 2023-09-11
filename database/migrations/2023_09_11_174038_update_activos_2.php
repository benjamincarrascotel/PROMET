<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActivos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos', function(Blueprint $table){

            $table->after('estado', function (Blueprint $table){
                $table->string('tiempo_uso_meses')->nullable();
                $table->string('centro_costos')->nullable();
                $table->string('tipo_moneda')->nullable();
                $table->string('archivo')->nullable();
                $table->string('archivo2')->nullable();
                $table->string('archivo3')->nullable();

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
        Schema::table('activos', function (Blueprint $table) {
            $table->dropColumn('archivo');
            $table->dropColumn('archivo2');
            $table->dropColumn('archivo3');
            $table->dropColumn('tiempo_uso_meses');
            $table->dropColumn('centro_costos');
            $table->dropColumn('tipo_moneda');


        });
    }
}
