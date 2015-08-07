<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('location');
            $table->rememberToken();
            $table->timestamps();
            //$table->increments('id_event');
            $table->string('event_name');
            $table->string('event_desc');
            $table->date('event_date');
            $table->text('event_location');
            $table->text('event_type');
            $table->boolear('event_privacy');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event');
    }
}
