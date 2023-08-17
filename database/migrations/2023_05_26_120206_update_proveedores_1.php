<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProveedores1 extends Migration
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
            $table->after('codigo', function (Blueprint $table){
                $table->string('rut')->nullable();
                $table->string('giro')->nullable();
                $table->string('natural_organizacion')->nullable();
                $table->string('direccion_com')->nullable();
                $table->string('comuna_com')->nullable();
                $table->string('region_com')->nullable();
                $table->string('email_com')->nullable();
                $table->string('telefono_com')->nullable();
                $table->string('persona_contacto_com')->nullable();
                $table->string('direccion_log')->nullable();
                $table->string('comuna_log')->nullable();
                $table->string('region_log')->nullable();
                $table->string('email_log')->nullable();
                $table->string('telefono_log')->nullable();
                $table->string('persona_contacto_log')->nullable();
                $table->string('nro_cuenta')->nullable();
                $table->string('tipo_cuenta')->nullable();
                $table->string('banco')->nullable();
                $table->string('moneda')->nullable();
                $table->string('email_pago')->nullable();
                $table->boolean('cheque_checkbox')->nullable();
                $table->boolean('vale_vista_checkbox')->nullable();
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
            $table->dropColumn('rut');
            $table->dropColumn('giro');
            $table->dropColumn('natural_organizacion');
            $table->dropColumn('direccion_com');
            $table->dropColumn('comuna_com');
            $table->dropColumn('region_com');
            $table->dropColumn('email_com');
            $table->dropColumn('telefono_com');
            $table->dropColumn('persona_contacto_com');
            $table->dropColumn('direccion_log');
            $table->dropColumn('comuna_log');
            $table->dropColumn('region_log');
            $table->dropColumn('email_log');
            $table->dropColumn('telefono_log');
            $table->dropColumn('persona_contacto_log');
            $table->dropColumn('nro_cuenta');
            $table->dropColumn('tipo_cuenta');
            $table->dropColumn('banco');
            $table->dropColumn('moneda');
            $table->dropColumn('email_pago');
            $table->dropColumn('cheque_checkbox');
            $table->dropColumn('vale_vista_checkbox');

        });
    }
}
