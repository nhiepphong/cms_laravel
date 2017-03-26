<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLogTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_log', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->dateTime('time');
            $table->string('ip', 20);
            $table->string('link', 255);
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->tinyInteger("is_active");
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
        Schema::drop('admin_log');
    }
}
