<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax() || $request->input('ajax')) {
            $data = ProgramStudi::query();
            if ($request->has('prodi') && $request->input('prodi')) {
                $data->where('id', $request->input('prodi'));
            }
            $dataTable = DataTables::of($data);
            $dataTable->addIndexColumn()
                ->addColumn('full_name', function ($row) {
                    return $row->jenjang_study.'-'.$row->nama_prodi;
                })
                ->rawColumns(['full_name']);
            return $dataTable->make();
        }

        return view('prodi.index');
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
        // Check if the kode already exists
        $existingProgramStudi = ProgramStudi::where('kode_prodi', $request->kode_prodi)->first();
        if ($existingProgramStudi) {
            // If the kode already exists, return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Kode program studi sudah ada.',
            ], 400);
        }

        // If the kode does not exist, save the data
        $insert = ProgramStudi::create($request->all());

        // Return a success response
        return response()->json([
            'status' => 'success',
            'message' => 'Data saved successfully',
            'data' => $insert // Return the created data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgramStudi  $programStudi
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgramStudi  $programStudi
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgramStudi  $programStudi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramStudi $prodi)
    {
        $prodi->fill($request->all())->save();
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
     * @param  \App\Models\ProgramStudi  $programStudi
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramStudi $prodi)
    {
        try {
            $prodi->delete();
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
}
