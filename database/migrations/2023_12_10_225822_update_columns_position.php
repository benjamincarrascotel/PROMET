<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsPosition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('ALTER TABLE `ventas` CHANGE `proyecto_id` `proyecto_id` VARCHAR(255) NULL  AFTER `activo_id`;');
        \DB::statement('ALTER TABLE `ventas` CHANGE `encargado` `encargado` VARCHAR(255) NULL  AFTER `fecha_termino`;');

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
