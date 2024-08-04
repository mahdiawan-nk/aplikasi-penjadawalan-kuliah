<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ViewUserTelegram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_user_telegram AS SELECT a.id AS id, a.id_prodi AS id_prodi, b.nama_prodi AS nama_prodi, b.jenjang_study AS jenjang_study, a.semester AS semester, a.nim AS nim, a.email AS email, a.nama AS nama, a.jenis_kelamin AS jenis_kelamin FROM mahasiswas a JOIN program_studis b ON a.id_prodi = b.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_user_telegram");
    }
}
