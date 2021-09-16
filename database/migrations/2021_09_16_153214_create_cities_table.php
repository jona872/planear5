<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');

                $table->bigInteger('province_id')->unsigned()->index()->nullable();
                $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');

                // $table->unsignedInteger('province_id'); //testing unsigned
                // $table->foreign('province_id')->references('id')->on('provinces');
                
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
        Schema::dropIfExists('cities');
    }
}
