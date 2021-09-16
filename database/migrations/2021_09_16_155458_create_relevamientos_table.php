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

                // $table->integer('id_responsable');
                // $table->foreign('id_responsable')->references('id')->on('users');
                $table->bigInteger('user_id')->unsigned()->index()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                // $table->integer('id_herramienta');
                // $table->foreign('id_herramienta')->references('id')->on('tools');
                $table->bigInteger('tool_id')->unsigned()->index()->nullable();
                $table->foreign('tool_id')->references('id')->on('tools')->onDelete('cascade');

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
