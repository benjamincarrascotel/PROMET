<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMantenciones3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mantenciones', function(Blueprint $table){
            $table->after('costo_mantencion', function (Blueprint $table){
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
        Schema::table('mantenciones', function (Blueprint $table) {
            $table->dropColumn('tipo_moneda');

        });
    }
}
