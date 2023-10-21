<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGeneral1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mantenciones', function(Blueprint $table){

            $table->after('estado', function (Blueprint $table){
                $table->boolean('arriendo_flag')->default(0);
                $table->boolean('venta_flag')->default(0);
            });

        });

        Schema::table('mantenciones', function(Blueprint $table){

            $table->after('estado', function (Blueprint $table){
                $table->string('observaciones')->nullable();
            });

        });

        Schema::table('ventas', function(Blueprint $table){

            $table->after('estado', function (Blueprint $table){
                $table->string('observaciones')->nullable();
            });

        });

        Schema::table('arriendo_activos', function(Blueprint $table){

            $table->after('estado', function (Blueprint $table){
                $table->string('observaciones')->nullable();
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
