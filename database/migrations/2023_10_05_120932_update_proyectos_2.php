<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProyectos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('objeto_imputacion');
            $table->dropColumn('area');
            $table->dropColumn('codigo_sap');
            $table->dropColumn('nombre_sap');
        });
    }
}
