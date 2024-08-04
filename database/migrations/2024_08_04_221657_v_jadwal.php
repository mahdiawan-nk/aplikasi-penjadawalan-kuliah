<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class VJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW v_jadwal AS SELECT a.id AS id, a.id_matkul AS id_matkul, a.id_kelas AS id_kelas, a.id_dosen AS id_dosen, CONCAT(b.kode_matkul, '-', b.nama_matkul) AS matakuliah, b.nama_matkul AS nama_matkul, e.periode AS periode, a.semester AS semester, c.nama_gedung AS nama_gedung, c.nama_kelas AS nama_kelas, c.kapasitas AS kapasitas, b.sks AS sks, d.nama_dosen AS nama_dosen, CONCAT(a.jam_mulai, '-', a.jam_selesai) AS jam, a.hari AS hari, a.rombel AS rombel, a.data_prodi AS data_prodi, a.status AS status, a.kunci AS kunci FROM penjadwalans a JOIN mata_kuliahs b ON a.id_matkul = b.id JOIN kelas c ON a.id_kelas = c.id JOIN dosens d ON a.id_dosen = d.id JOIN semesters e ON b.id_semester = e.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS v_jadwal");
    }
}
