<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        User::create([
            'name'=>'Operator',
            'email'=>'operator@mail.com',
            'password'=>Hash::make('12345678'),
            'role'=>1
        ]);
        // for ($i = 1; $i <= 50; $i++) {
        //     $jenjangOptions = ['D3', 'D4', 'S1', 'S2', 'Profesi'];
        //     $jenjangRandom = $jenjangOptions[array_rand($jenjangOptions)];

        //     ProgramStudi::create([
        //         'kode_prodi' => 'PRODI-' . $i,
        //         'nama_prodi' => 'Program Studi ' . $i,
        //         'alias' => 'PS-' . $i,
        //         'jenjang_study' => $jenjangRandom
        //     ]);
        // }

        // $mataKuliah = [];
        // $jenisMataKuliah = ['P', 'T'];

        // for ($prodi = 1; $prodi <= 30; $prodi++) {
        //     for ($semester = 1; $semester <= 8; $semester++) {
        //         for ($i = 1; $i <= 5; $i++) {
        //             // Mata kuliah praktek
        //             $mataKuliah[] = [
        //                 'kode_matkul' => 'MK-P-' . $prodi . '-' . $semester . '-' . $i,
        //                 'id_prodi' => $prodi,
        //                 'id_semester' => $semester,
        //                 'nama_matkul' => 'Mata Kuliah Praktek ' . $i,
        //                 'type_matkul' => 'P',
        //                 'sks' => rand(2, 4),
        //                 'created_at' => now(),
        //                 'updated_at' => now()
        //             ];

        //             // Mata kuliah teori
        //             $mataKuliah[] = [
        //                 'kode_matkul' => 'MK-T-' . $prodi . '-' . $semester . '-' . $i,
        //                 'id_prodi' => $prodi,
        //                 'id_semester' => $semester,
        //                 'nama_matkul' => 'Mata Kuliah Teori ' . $i,
        //                 'type_matkul' => 'T',
        //                 'sks' => rand(1, 4),
        //                 'created_at' => now(),
        //                 'updated_at' => now()
        //             ];
        //         }
        //     }
        // }

        // DB::table('mata_kuliahs')->insert($mataKuliah);
        // $gedung = ['A', 'B', 'C', 'D'];
        // $kapasitasOptions = [
        //     '25 - 30',
        //     '31 - 40',
        //     '41 - 50',
        //     '51 - 65'
        // ];

        // $ruangan = [];

        // foreach ($gedung as $gedungName) {
        //     for ($i = 1; $i <= 8; $i++) {
        //         $kapasitasIndex = floor(($i - 1) / 2);
        //         $kapasitas = $kapasitasOptions[$kapasitasIndex];

        //         $ruangan[] = [
        //             'nama_gedung' => 'Gedung ' . $gedungName,
        //             'nama_kelas' => 'Ruang ' . $gedungName . '-' . $i,
        //             'kapasitas' => $kapasitas,
        //             'created_at' => now(),
        //             'updated_at' => now()
        //         ];
        //     }
        // }

        // DB::table('kelas')->insert($ruangan);
        // $totalProdi = 30;
        // $minDosen = 5;
        // $maxDosen = 10;

        // $dosen = [];

        // for ($prodi = 1; $prodi <= $totalProdi; $prodi++) {
        //     $totalDosen = rand($minDosen, $maxDosen);

        //     for ($i = 1; $i <= $totalDosen; $i++) {
        //         $dosen[] = [
        //             'id_prodi' => $prodi,
        //             'nidn' => 'NIDN' . $prodi . '-' . $i,
        //             'nama_dosen' => 'Dosen ' . $prodi . '-' . $i,
        //             'created_at' => now(),
        //             'updated_at' => now()
        //         ];
        //     }
        // }

        // DB::table('dosens')->insert($dosen);
    }
}
