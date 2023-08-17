<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProveedores3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proveedores', function(Blueprint $table){
            $table->after('rut', function (Blueprint $table){
                $table->string('rut_dv')->nullable();
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
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropColumn('rut_dv');
        });
    }
}
