<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelevamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('relevamientos')) {
            Schema::create('relevamientos', function (Blueprint $table) {
                $table->id();
                
                $table->integer('id_responsable')->unsigned();
                $table->foreign('id_responsable')->references('id')->on('users');

                $table->integer('id_herramienta')->unsigned();
                $table->foreign('id_herramienta')->references('id')->on('tools');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relevamientos');
    }
}
