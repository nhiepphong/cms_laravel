<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenuTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menu', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 45);
            $table->integer('parent_id');
            $table->string('model', 255);
            $table->string('controller', 255);
            $table->string('link', 255);
            $table->integer('p_order');
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
        Schema::drop('admin_menu');
    }
}
