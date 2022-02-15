<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('project_name');

                // $table->integer('id_ciudad'); //testing unsigned
                // $table->foreign('id_ciudad')->references('id')->on('cities');
                $table->bigInteger('city_id')->unsigned()->index()->nullable();
                $table->foreign('city_id')->references('id')->on('cities');

                $table->string('project_creator')->nullable();
                $table->string('project_latitud')->nullable();
                $table->string('project_longitud')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
