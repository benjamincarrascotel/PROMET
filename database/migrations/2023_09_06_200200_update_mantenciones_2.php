<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMantenciones2 extends Migration
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
                $table->string('comprobante_termino')->nullable();
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
            $table->dropColumn('comprobante_termino');

        });
    }
}
