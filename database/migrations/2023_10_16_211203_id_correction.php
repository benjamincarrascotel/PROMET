<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IdCorrection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::dropIfExists('proyectos');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('centro_costo')->nullable();
            $table->string('estado')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('proyectos', function(Blueprint $table){

            $table->after('centro_costo', function (Blueprint $table){
                $table->string('rut')->nullable();
                $table->string('empresa')->nullable();
            });

        });

        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('rut');
            $table->dropColumn('empresa');

            $table->after('id', function (Blueprint $table){
                $table->integer('empresa_id')->nullable();
            });

        });

        Schema::table('proyectos', function(Blueprint $table){

            $table->after('centro_costo', function (Blueprint $table){
                
                $table->string('objeto_imputacion')->nullable();
                $table->string('area')->nullable();
                $table->string('sociedad_sap')->nullable();
                $table->string('codigo_sap')->nullable();
                $table->string('nombre_sap')->nullable();
            });

        });
    }
}
