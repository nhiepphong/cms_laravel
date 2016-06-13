<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user', function (Blueprint $table) {

            $table->increments('id');
            $table->string('username', 45);
            $table->integer('group_id');
            $table->string('password', 255);
            $table->string('fullname', 255);
            $table->text('permissions');
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
        Schema::drop('admin_user');
    }
}
