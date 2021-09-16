<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tools_data')) {
            Schema::create('tools_data', function (Blueprint $table) {
                $table->id();

                $table->integer('id_herramienta');
                $table->foreign('id_herramienta')->references('id')->on('tools');

                $table->integer('id_dato');
                $table->foreign('id_dato')->references('id')->on('data');

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
        Schema::dropIfExists('tools_data');
    }
}
