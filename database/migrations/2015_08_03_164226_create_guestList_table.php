<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guestList', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_user')->unsigned();
            $table->integer('fk_event')->unsigned();
            $table->foreign('fk_user')->references('id')->on('users');
            $table->foreign('fk_event')->references('id')->on('event');
            $table->rememberToken();
            $table->timestamps();
            //este admas tendria que tener un array de nombres(no de usuarios), xq puede
            //q los que invites no sean usuarios.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('guestList');
    }
}
