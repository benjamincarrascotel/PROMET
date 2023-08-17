<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambiosSAPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios_SAP', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->nullable();
            $table->integer('SAP_antiguo')->nullable();
            $table->integer('SAP_nuevo')->nullable();
            $table->string('fecha')->nullable();
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
        Schema::dropIfExists('cambios_SAP');
    }
}
