<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_prodi')->nullable();
            $table->unsignedInteger('nidn_nim')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role')->comment('1=>Operator 2=>Kaprodi 3=>dosen 4=>Mahasiswa');
            $table->string('id_telegram')->nullable();
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
        Schema::dropIfExists('users');
    }
}
