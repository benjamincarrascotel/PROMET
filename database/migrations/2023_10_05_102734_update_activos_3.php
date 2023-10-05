<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActivos3 extends Migration
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
                $table->boolean('inoperativo')->default(0);

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
        Schema::table('activos', function(Blueprint $table){
            $table->dropColumn('inoperativo');

        });
    }
}
