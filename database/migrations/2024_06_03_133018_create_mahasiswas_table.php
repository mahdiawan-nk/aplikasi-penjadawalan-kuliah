<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_prodi')->nullable();
            $table->unsignedInteger('semester')->nullable();
            $table->string('nim')->nullable();
            $table->string('email')->nullable();
            $table->string('nama')->nullable();
            $table->string('kelas')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->integer('is_update')->default(0);
            $table->timestamps();

            $table->foreign('id_prodi')->references('id')->on('program_studis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
}
