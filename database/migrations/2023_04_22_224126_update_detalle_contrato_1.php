<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDetalleContrato1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_contratos', function(Blueprint $table){
            $table->string('criticidad_ops')->nullable()->change();
            $table->string('criticidad_personas')->nullable()->change();
            $table->string('cantidad_areas_invo')->nullable()->change();


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
