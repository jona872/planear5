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
                // $table->bigInteger('user_id')->unsigned()->index()->nullable();
                // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('relevamiento_creator')->nullable();

                $table->bigInteger('project_id')->unsigned()->index()->nullable();
                $table->foreign('project_id')->references('id')->on('projects');

                $table->bigInteger('tool_id')->unsigned()->index()->nullable();
                $table->foreign('tool_id')->references('id')->on('tools');

                $table->bigInteger('user_id')->unsigned()->index()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                
                $table->string('relevamiento_latitud')->nullable();
                $table->string('relevamiento_longitud')->nullable();
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
