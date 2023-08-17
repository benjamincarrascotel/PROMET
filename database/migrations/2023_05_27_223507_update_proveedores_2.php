<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProveedores2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proveedores', function(Blueprint $table){
            //$table->string('nombre')->nullable();
            $table->after('vale_vista_checkbox', function (Blueprint $table){
                $table->string('sociedad_a_facturar')->nullable();
                //$table->string('codigo')->nullable();
                $table->string('nombre_solicitante')->nullable();
                $table->string('cargo_solicitante')->nullable();
                $table->string('departamento_solicitante')->nullable();
                $table->string('jefatura_solicitante')->nullable();
                $table->string('condiciones_pago')->nullable();
                $table->string('tipo_documento')->nullable();
                $table->string('descripcion')->nullable();
                $table->string('fecha_solicitud')->nullable();
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
            $table->dropColumn('sociedad_a_facturar');
            //$table->dropColumn('codigo');
            $table->dropColumn('nombre_solicitante');
            $table->dropColumn('cargo_solicitante');
            $table->dropColumn('departamento_solicitante');
            $table->dropColumn('jefatura_solicitante');
            $table->dropColumn('condiciones_pago');
            $table->dropColumn('tipo_documento');
            $table->dropColumn('descripcion');
            $table->dropColumn('fecha_solicitud');

        });
    }
}
