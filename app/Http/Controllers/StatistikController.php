<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\ProgramStudi;

class StatistikController extends Controller
{
    public function carddata() {
        $kelas = Kelas::count();
        $matakuliah = MataKuliah::count();
        $dosen = Dosen::count();
        $program_studi = ProgramStudi::count();

        $data = [
            'status' => 'success',
            'message' => 'Data Found',
            'data' => [
                'kelas'=>$kelas,
                'matakuliah'=>$matakuliah,
                'dosen'=>$dosen,
                'prodi'=>$program_studi
            ]
        ];
        return response()->json($data, 200);
    }
}
