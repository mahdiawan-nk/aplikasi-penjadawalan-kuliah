<?php

namespace App\Http\Controllers;

use App\Models\KelasMahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class KelasMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = KelasMahasiswa::with('programstudi')->latest('id');

        if ($request->has('prodi') && $request->input('prodi') != 0) {
            $prodi = $request->input('prodi');
            if (strpos($prodi, '-') !== false) {
                $prodiArray = explode('-', $prodi);
                $query->whereIn('id_program_study', $prodiArray);
            } else {
                $query->where('id_program_study', $prodi);
            }
        }

        if ($request->has('paginate')) {
            $dataKelasMahasiswa = $query->paginate($request->input('paginate'));
        } else {
            $dataKelasMahasiswa = $query->get();
        }

        return response()->json($dataKelasMahasiswa);
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
        $insert = KelasMahasiswa::create($request->all());
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
     * @param  \App\Models\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(KelasMahasiswa $kelasmahasiswa)
    {
        $data = [
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $kelasmahasiswa
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(KelasMahasiswa $kelasMahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KelasMahasiswa $kelasmahasiswa)
    {
        $kelasmahasiswa->fill($request->all())->save();
        $data = [
            'status' => 'success',
            'message' => 'Data update successfully',
            'data' => $request->all()
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KelasMahasiswa  $kelasMahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(KelasMahasiswa $kelasmahasiswa)
    {
        try {
            $kelasmahasiswa->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data Berhasil Di hapus',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Tidak Dapat dihapus karena terhubung ke data',
            ], 422);
        }
    }
}
