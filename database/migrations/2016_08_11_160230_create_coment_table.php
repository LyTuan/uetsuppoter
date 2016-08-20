<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uet_coment', function (Blueprint $table) {
            $table->increments('id');
            $table->text('coment');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('uet_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('uet_coment');
    }
}
