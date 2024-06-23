<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

use function App\Helpers\encrypt;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax() || $request->input('ajax')) {
            $data = Kelas::query();
            $dataTable = DataTables::of($data);

            return $dataTable->make();
        }

        return view('kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = Kelas::create($request->all());
        $data = [
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $request->all()
        ];
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        $kela->fill($request->all())->save();
        $data = [
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $request->all()
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        try {
            $kela->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data Berhasil Di hapus',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Tidak Dapat dihapus karena terhubung ke data penjadwalan',
            ], 422);
        }
    }

    public function getRuanganGrouped()
    {
        $ruangan = Kelas::all();

        $groupedRuangan = $ruangan->groupBy('nama_gedung')->map(function ($items) {
            return $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' =>  $item->nama_kelas . ' (' . $item->kapasitas . ')'
                ];
            });
        });

        $groupedRuanganFormatted = $groupedRuangan->map(function ($ruangans, $gedungName) {
            return [
                'text' => 'Gedung ' . $gedungName,
                'children' => $ruangans->toArray()
            ];
        });

        return response()->json($groupedRuanganFormatted->values());
    }

    public function getKelasKosong(Request $request)
    {
        // // Mengatur locale ke bahasa Indonesia
        Carbon::setLocale('id');
        $hari = Carbon::now()->translatedFormat('l');
        $jam_mulai = '07:00';
        $jam_selesai = '16:00';

        // Query untuk mendapatkan semua data kelas
        $keyword = $request->input('keyword');
        $kelas = Kelas::with(['jadwalKelas' => function ($query) use ($hari, $jam_mulai, $jam_selesai) {
            $query->where('hari', $hari)->where('status_penggunaan', 1)
                ->where(function ($q) use ($jam_mulai, $jam_selesai) {
                    $q->whereBetween('jam_mulai', [$jam_mulai, $jam_selesai])
                        ->orWhereBetween('jam_selesai', [$jam_mulai, $jam_selesai])
                        ->orWhere(function ($subQuery) use ($jam_mulai, $jam_selesai) {
                            $subQuery->where('jam_mulai', '<=', $jam_mulai)
                                ->where('jam_selesai', '>=', $jam_selesai);
                        });
                });
        }])
            ->when($keyword, function ($query) use ($keyword) {
                // Menambahkan kondisi where like jika ada keyword
                $query->where('nama_kelas', 'like', '%' . $keyword . '%');
                $query->orWhere('nama_gedung', 'like', '%' . $keyword . '%');
            })
            ->get();

        $kelasKosong = [];
        $kelasTerisi = [];

        foreach ($kelas as $kls) {
            if ($kls->jadwalKelas->isEmpty()) {
                $kls->uid = encrypt($kls->id); // Tambahkan uid ke objek kelas
                $kelasKosong[] = $kls;
            } else {
                $kls->uid = encrypt($kls->id); // Tambahkan uid terenkripsi ke objek kelas
                $kelasTerisi[] = $kls;
            }
        }

        return response()->json([
            'kelas_kosong' => $kelasKosong,
            'kelas_terisi' => $kelasTerisi,
            'hari' => $hari
        ]);
    }
}
