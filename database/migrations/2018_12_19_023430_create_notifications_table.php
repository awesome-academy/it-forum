<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_content_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('target_id')->unsigned()->nullable();
            $table->integer('post_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreign('notification_content_id')->references('id')->on('notification_contents');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('target_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->softDeletes();
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
        Schema::dropIfExists('notifications');
    }
}
