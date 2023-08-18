<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateActivos1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activos', function(Blueprint $table){
            $table->after('valor_residual', function (Blueprint $table){
                $table->string('foto')->nullable();
                $table->string('codigo_qr')->nullable();
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
        Schema::table('activos', function (Blueprint $table) {
            $table->dropColumn('foto');
            $table->dropColumn('codigo_qr');
            $table->dropColumn('estado');

        });
    }
}
