<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id_task');
            // $table->primary('id_task');
            $table->text('task_name')->nullable();
            $table->integer('fk_user');
            $table->index('fk_user');
            $table->foreign('fk_user')->references('id')->on('users');            
            $table->timestamps();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task');
    }
}
