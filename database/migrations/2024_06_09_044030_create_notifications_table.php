<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedInteger('id_user_sender');
            $table->unsignedInteger('id_user_receiver');
            $table->string('title');
            $table->text('body');
            $table->boolean('is_read')->default(0);
            $table->timestamps();

            $table->foreign('id_user_sender')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_user_receiver')->references('id')->on('users')->onDelete('cascade');
            
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
