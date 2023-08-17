<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdminContrato1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('contratos', function(Blueprint $table){
            $table->renameColumn('gestionador', 'admin_contrato_id');

        });
        Schema::create('admin_contratos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
