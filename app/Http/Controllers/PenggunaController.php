<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax() || $request->input('ajax')) {
            $data = User::with('dataProdi')->get();
            return DataTables::of($data)->make();
        }

        return view('pengguna.index');
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
        $dataPost = [
            'name' => $request->name,
            'email' => $request->email,
            'nidn_nim' => $request->nidn_nim,
            'id_prodi' => $request->prodi,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];

        $userExist = User::where('nidn_nim', $request->nidn_nim)
            ->orWhere('email', $request->email)
            ->exists();

        if ($userExist) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pendaftaran Gagal'
            ], 400);
        }
        User::create($dataPost);
        return response()->json([
            'status' => 'OK',
            'message' => 'Login Berhasil',
            'data' => $request->all()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pengguna)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pengguna)
    {
        $dataPost = [
            'name' => $request->name,
            'email' => $request->email,
            'nidn_nim' => $request->nidn_nim,
            'id_prodi' => $request->prodi,
            'role' => $request->role
        ];
        if ($request->password != null) {
            $dataPost['password'] = Hash::make($request->password);
        }
        User::where('id', $pengguna)->update($dataPost);
        return response()->json([
            'status' => 'OK',
            'message' => 'Login Berhasil',
            'data' => $dataPost
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil Di hapus',
        ]);
    }

    public function deleteUser($id,$type)
    {
        $data = $this->getUserDataByIdAndType($id, $type);
        User::where('email',$data->email)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil Di hapus',
        ]);
    }

    public function createUser($id, $type)
    {
        $data = $this->getUserDataByIdAndType($id, $type);
        if ($type == 'mhs') {
            $dataPost = [
                'name' => $data->nama,
                'email' => $data->email,
                'password' => Hash::make($data->nim),
                'role' => 4
            ];
        } else {
            $dataPost = [
                'name' => $data->nama_dosen,
                'email' => $data->email,
                'password' => Hash::make($data->nidn),
                'role' => 3
            ];
        }
        if ($dataPost['email'] == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pendaftaran Gagal'
            ], 400);
        }

        User::create($dataPost);
        return response()->json([
            'status' => 'OK',
            'message' => 'Login Berhasil',
            'data'=>$dataPost
        ], 200);
    }


    private function getUserDataByIdAndType($id, $type)
    {
        if ($type == 'mhs') {
            return Mahasiswa::where('id', $id)->first();
        } else {
            return Dosen::where('id', $id)->first();
        }
    }
}
