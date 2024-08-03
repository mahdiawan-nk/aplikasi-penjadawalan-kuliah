<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_mahasiswas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_program_study');
            $table->string('nama_kelas');
            $table->integer('jumlah_mahasiswa');
            $table->timestamps();

            $table->foreign('id_program_study')->references('id')->on('program_studis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas_mahasiswas');
    }
}
