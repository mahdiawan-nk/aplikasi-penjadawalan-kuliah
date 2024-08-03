<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use function App\Helpers\infoUser;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prodiUsers = infoUser()->id_prodi;

        // if (request()->ajax() || $request->input('ajax')) {
            $prodiFilter = request()->input('prodi');
            $data = DB::table('v_jadwal');
            if ($prodiFilter != "all") {

                $data->where('data_prodi', 'like', '%' . $prodiFilter . '%');
            }
            if (session('role') == 4) {
                
                $data->where('semester', $this->getSemester()->semester);
                $data->where('data_prodi', 'like', '%' . $this->getSemester()->id_prodi. '%');
            }
            if (session('role') == 3) {
                $users = Dosen::where('email', session('email'))->first()->id;
                $data->where('id_dosen', $users);
            }

            if (session('role') == 2) {
                $data->where('data_prodi', 'like', '%' . $prodiUsers . '%');
            }

            $data->get();

            $dataTable = DataTables::of($data);
            $dataTable->addIndexColumn()
                ->addColumn('data_prodi', function ($row) {
                    return $this->dataProdi(explode(',', $row->data_prodi));
                })
                ->addColumn('data_gedung', function ($row) {
                    return $row->nama_gedung . ' ' . $row->nama_kelas . '(Kapasitas ' . $row->kapasitas . ' MHS)';
                })
                ->addColumn('data_filter', function ($row) use ($prodiFilter) {
                    return $prodiFilter;
                })
                ->addColumn('data_action', function ($row) use ($prodiFilter) {
                    return ['id'=>$row->id,'hari'=>$row->hari];
                })
                ->rawColumns(['data_gedung', 'data_filter','data_action']);

            return $dataTable->make();
        // }

        // return view('penjadwalan.index');
    }

    private function getSemester(){
        $dataUser = Mahasiswa::where('email',session('email'))->first();

        return $dataUser;
    }

    private function dataProdi($data)
    {
        // Decode the JSON data into an array
        $prodiArray = $data;

        // Check if decoding was successful
        if ($prodiArray === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error, maybe return an error response or throw an exception
            throw new \InvalidArgumentException('Invalid JSON data');
        }

        // Retrieve program studies based on the IDs from the decoded array
        $prodi = ProgramStudi::select('id', 'nama_prodi')
            ->whereIn('id', $prodiArray)
            ->get();
        $data = [];
        foreach ($prodi as $item) {
            $data[] = [
                'id' => $item->id,
                'nama_prodi' => $item->nama_prodi
            ];
        }
        return json_decode($prodi);
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
    // public function store(Request $request)
    // {
    //     $dataPost = [
    //         'id_matkul' => $request->input('id_matkul'),
    //         'id_kelas' => $request->id_kelas,
    //         'id_dosen' => $request->id_dosen,
    //         'hari' => $request->hari,
    //         'jam_mulai' => $request->jam_mulai,
    //         'jam_selesai' => $request->jam_selesai,
    //         'rombel' => $request->rombel,
    //         'data_prodi' => implode(',', $request->prodi_id)
    //     ];

    //     // Pemeriksaan apakah ruangan sudah terisi pada hari dan jam yang sama
    //     $existingSchedule = Penjadwalan::where('id_kelas', $request->id_kelas)
    //         ->where('hari', $request->hari)
    //         ->where(function ($query) use ($request) {
    //             $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
    //                 ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
    //         })
    //         ->exists();

    //     if ($existingSchedule) {
    //         // Ruangan sudah terisi, kirim pesan error
    //         $data = [
    //             'status' => 'error',
    //             'message' => 'Ruangan sudah diisi pada jadwal yang sama',
    //             'data' => $dataPost
    //         ];
    //         return response()->json($data, 400);
    //     }

    //     // Ruangan belum terisi, simpan data
    //     Penjadwalan::create($dataPost);

    //     // Kirim respons sukses
    //     $data = [
    //         'status' => 'success',
    //         'message' => 'Data retrieved successfully',
    //         'data' => $dataPost
    //     ];
    //     return response()->json($data);
    // }
    public function store(Request $request)
    {
        $dataPost = [
            'id_matkul' => $request->input('id_matkul'),
            'id_kelas' => $request->id_kelas,
            'id_dosen' => $request->id_dosen,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'rombel' => $request->rombel,
            'semester' => $request->semester,
            'data_prodi' => implode(',', $request->prodi_id)
        ];

        // Pemeriksaan bentrok ruangan
        $conflictRoom = Penjadwalan::where('id_kelas', $request->id_kelas)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            });

        if ($conflictRoom->exists()) {
            $data = [
                'status' => 'error',
                'message' => 'Ruangan sudah diisi pada jadwal yang sama',
                'data' => $conflictRoom->get()
            ];
            return response()->json($data, 200);
        }

        // Pemeriksaan bentrok dosen
        $conflictDosen = Penjadwalan::where('id_dosen', $request->id_dosen)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($conflictDosen) {
            $data = [
                'status' => 'error',
                'message' => 'Dosen sudah memiliki jadwal pada waktu yang sama',
                'data' => $dataPost
            ];
            return response()->json($data, 200);
        }

        // Pemeriksaan bentrok semester
        $conflictSemester = Penjadwalan::where('semester', $request->semester)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($conflictSemester) {
            $data = [
                'status' => 'error',
                'message' => 'Semester sudah memiliki jadwal pada waktu yang sama',
                'data' => $dataPost
            ];
            return response()->json($data,200);
        }

        // Ruangan belum terisi, simpan data
        Penjadwalan::create($dataPost);

        // Kirim respons sukses
        $data = [
            'status' => 'success',
            'message' => 'Data berhasil disimpan',
            'data' => $dataPost
        ];
        return response()->json($data);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function show($penjadwalan)
    {

        $data = DB::table('v_jadwal')->where('id', $penjadwalan)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $penjadwalan)
    {

        $dataPost = [
            'id_matkul' => $request->input('id_matkul'),
            'id_kelas' => $request->id_kelas,
            'id_dosen' => $request->id_dosen,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'rombel' => $request->rombel,
            'data_prodi' => implode(',', $request->prodi_id)
        ];
        Penjadwalan::where('id', $penjadwalan)->update($dataPost);
        $data = [
            'id' => $penjadwalan,
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $dataPost
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjadwalan  $penjadwalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjadwalan $penjadwalan)
    {
        $penjadwalan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil Di hapus',
        ]);
    }
}
