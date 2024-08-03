<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TahunAkademik::latest('id')->get();
        return DataTables::of($data)->make();
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
        $dataTa = TahunAkademik::where('kode_akademik', $request->kode_akademik)->first();
        if ($dataTa) {
            $data = [
                'status' => 'error',
                'message' => 'Tahun akademik sudah ada'
            ];
            return response()->json($data, 200);
        }

        $insert = TahunAkademik::create($request->all());
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
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAkademik $tahunakademik)
    {
        $KodeAkademik = explode('-', $tahunakademik->kode_akademik);
        $tahunakademik->jenis_periode = $KodeAkademik[1] == 1 ? 'Ganjil' : 'Genap';
        $data = [
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $tahunakademik
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function edit(TahunAkademik $tahunAkademik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAkademik $tahunakademik)
    {
        $tahunakademik->fill($request->all())->save();
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
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAkademik $tahunAkademik)
    {
        //
    }
}
