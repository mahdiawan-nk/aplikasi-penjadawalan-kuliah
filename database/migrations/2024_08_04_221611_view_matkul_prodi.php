<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ViewMatkulProdi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_matkul_prodi AS SELECT a.id AS id, a.kode_matkul AS kode_matkul, a.id_prodi AS id_prodi, a.id_semester AS id_semester, a.nama_matkul AS nama_matkul, a.type_matkul AS type_matkul, a.sks AS sks, a.created_at AS created_at, a.updated_at AS updated_at, b.alias AS alias FROM mata_kuliahs a JOIN program_studis b ON a.id_prodi = b.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_matkul_prodi");
    }
}
