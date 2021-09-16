<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('provinces')) {
            Schema::create('provinces', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');

                $table->bigInteger('country_id')->unsigned()->index()->nullable();
                $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

                // $table->integer('country_id')->unsigned(); //testing unsigned
                // $table->foreign('country_id')->references('id')->on('countries');

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
        Schema::dropIfExists('provinces');
    }
}
