<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContratoMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contrato_mails', function (Blueprint $table) {
            $table->id();
            $table->integer('contrato_id')->nullable();
            $table->integer('estado_contrato')->nullable();
            $table->string('user_type')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('user_email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('admin_contratos', function(Blueprint $table){
            $table->string('email')->nullable()->after('nombre');
        });

        Schema::table('abastecimiento_users', function(Blueprint $table){
            $table->string('email')->nullable()->after('nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_contrato_mails');
        Schema::table('admin_contratos', function (Blueprint $table) {
            $table->dropColumn('email');
        });
        Schema::table('abastecimiento_users', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
