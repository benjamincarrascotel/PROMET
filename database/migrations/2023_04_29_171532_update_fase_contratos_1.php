<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFaseContratos1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fase_contratos', function (Blueprint $table) {
            $table->string('creado')->nullable()->after('contrato_id');
            $table->string('stand_by')->nullable()->after('adjudicacion');
            $table->string('adjudicacion_directa')->nullable()->after('stand_by');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fase_contratos', function (Blueprint $table) {
            $table->dropColumn('creado');
            $table->dropColumn('stand_by');
            $table->dropColumn('adjudicacion_directa');

        });
    }
}
