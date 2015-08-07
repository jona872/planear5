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
            $table->integer('event_owner')->unsigned();
            $table->string('event_name')->unique();
            $table->string('event_desc');
            $table->date('event_date');
            $table->string('event_type');
            $table->string('event_loca');//tendria que ser point para las coordenadas
            $table->boolean('event_priv');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('event_owner')->references('id')->on('users');
            //dejar esto 
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
