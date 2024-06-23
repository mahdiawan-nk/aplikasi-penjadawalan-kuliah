<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->input('ajax')) {
            $query = MataKuliah::with(['dataProdi:id,nama_prodi', 'dataSemester:id,semester']);

            if ($request->has('prodi') && $request->input('prodi')) {
                $id = explode('-', $request->input('prodi'));
                $query->whereIn('id_prodi', $id);
            }
            if ($request->has('smt') && $request->input('smt')) {
                $query->where('id_semester', $request->input('smt'));
            }

            $data = $query->get();
            $dataTable = DataTables::of($data);

            return $dataTable->make(true);
        }

        return view('matkul.index');
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
        $insert = MataKuliah::create($request->all());
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
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function edit(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataKuliah $matakuliah)
    {
        $matakuliah->fill($request->all())->save();
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
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataKuliah $matakuliah)
    {
        try {
            $matakuliah->delete();
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

    public function getGrouped(Request $request)
    {
        // Mengambil data program studi
        $prodi = DB::table('view_matkul_prodi')->select('id', 'nama_matkul as text','id_semester','alias as nama_prodi');

        if ($request->has('prodi')) {
            $id = explode('-', $request->input('prodi'));
            $prodi->whereIn('id_prodi', $id);
        }
        if ($request->has('smt')) {
            $prodi->where('id_semester', $request->smt);
        }

        $dataProdi = $prodi->get();

        foreach ($dataProdi as $item) {
            $data[]=[
                'id'=>$item->id,
                'text'=>'['.$item->nama_prodi.'][SMT-'.$item->id_semester.']-'.$item->text
            ];
        }


        return response()->json($data);
    }
}
