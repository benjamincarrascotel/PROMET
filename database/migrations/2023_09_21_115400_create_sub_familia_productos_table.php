<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubFamiliaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_familia_productos', function (Blueprint $table) {
            $table->id();
            $table->integer('familia_id')->nullable();
            $table->string('nombre')->nullable();
            $table->string('acronimo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('activos', function(Blueprint $table){

            $table->after('id', function (Blueprint $table){
                $table->boolean('sub_familia_id')->nullable();

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
        Schema::dropIfExists('sub_familia_productos');
    }
}
