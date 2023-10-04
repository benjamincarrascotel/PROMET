<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('rut')->nullable();
            $table->string('giro')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropColumn('rut');
            $table->dropColumn('empresa');

            $table->after('id', function (Blueprint $table){
                $table->integer('empresa_id')->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
