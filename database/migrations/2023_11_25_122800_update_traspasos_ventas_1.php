<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTraspasosVentas1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traspaso_ventas', function(Blueprint $table){

            $table->after('id', function (Blueprint $table){
                $table->boolean('proceso_cambio_flag')->default(0);
                $table->integer('proceso_anterior_id')->nullable();
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
