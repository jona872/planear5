<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('data_answers')) {
            Schema::create('data_answers', function (Blueprint $table) {
                $table->id();

                $table->bigInteger('data_id')->unsigned()->index()->nullable();
                $table->foreign('data_id')->references('id')->on('data');

                $table->bigInteger('answer_id')->unsigned()->index()->nullable();
                $table->foreign('answer_id')->references('id')->on('answers');

                $table->bigInteger('relevamiento_id')->unsigned()->index()->nullable();
                $table->foreign('relevamiento_id')->references('id')->on('relevamientos');

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
        Schema::dropIfExists('data_answers');
    }
}
