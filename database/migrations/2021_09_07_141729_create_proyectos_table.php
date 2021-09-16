<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('proyectos')) {
            Schema::create('proyectos', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->integer('id_ciudad')->unsigned(); //testing unsigned
                $table->foreign('id_ciudad')->references('id')->on('ciudad');
                $table->integer('id_creador');
                $table->foreign('id_creador')->references('id')->on('users');
                $table->string('latitud')->nullable();
                $table->string('longitud')->nullable();
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
        Schema::dropIfExists('proyectos');
    }
}
