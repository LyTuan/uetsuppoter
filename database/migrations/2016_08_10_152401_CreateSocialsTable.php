<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('uet_socials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('provider_user_id');
            $table->string('provider');
            $table->string('avatar');
            $table->integer('level');
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
        Schema::drop('uet_socials');
    }
}
