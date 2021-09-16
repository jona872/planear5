<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsRelevamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('projects_relevamientos')) {
            Schema::create('projects_relevamientos', function (Blueprint $table) {
                $table->id();

                $table->integer('id_proyecto');
                $table->foreign('id_proyecto_relevamiento')->references('id')->on('projects');

                $table->integer('id_relevamiento');
                $table->foreign('id_relevamiento')->references('id')->on('relevamientos');

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
        Schema::dropIfExists('projects_relevamientos');
    }
}
