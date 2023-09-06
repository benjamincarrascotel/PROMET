<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMantenciones1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mantenciones', function(Blueprint $table){
            $table->after('contacto_proveedor', function (Blueprint $table){
                $table->string('estado')->nullable();
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
            $table->dropColumn('estado');
        });
    }
}
