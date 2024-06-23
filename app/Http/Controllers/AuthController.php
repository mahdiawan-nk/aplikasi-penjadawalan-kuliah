<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->get('login') == true) {
            return redirect()->route('home');
        }
        return view('welcome');
    }

    public function registrasi()
    {
        return view('registrasi');
    }

    public function saveregistrasi(Request $request)
    {
        $dataPost = [
            'name' => $request->name,
            'id_prodi'=>$request->prodi,
            'email' => $request->email,
            'nidn_nim'=>$request->nidn_nim,
            'password' => Hash::make($request->password),
            'role' => 4
        ];

        $dataMahasiswa =[
            'id_prodi'=>$request->prodi,
            'semester'=>null,
            'nim'=>$request->nidn_nim,
            'email'=>$request->email,
            'nama'=>$request->name,
            'kelas'=>null
        ];

        $userExist = User::Where('email', $request->email)
            ->exists();

        if ($userExist) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pendaftaran Gagal'
            ], 400);
        }


        Mahasiswa::create($dataMahasiswa);
        User::create($dataPost);
        return response()->json([
            'status' => 'OK',
            'message' => 'Login Berhasil'
        ], 200);
    }
    /**
     * validateUser a newly checking user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateUser(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string', // changed 'email' to 'identifier'
            'password' => 'required|string',
        ]);

        // Search user by email or username
        $user = User::where('email', $request->identifier)
            ->orWhere('name', $request->identifier)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login gagal. Silakan coba lagi.',
            ], 401);
        }

        session([
            'login' => true,
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role,
        ]);

        return response()->json([
            'status' => 'OK',
            'message' => 'Login Berhasil'
        ], 200);
    }


    /**
     * Display the specified resource.
     *
     */
    public function home()
    {
        if(session('role') ==  4){
            $checkInfoUpdate = Mahasiswa::with(['dataProdi:id,nama_prodi'])->where('email',session('email'))->where('is_update',0);
            if($checkInfoUpdate->exists()){
                $data['info']=$checkInfoUpdate->first();
                return view('mahasiswa.update_info',$data);
            }
            return view('dashboard');
        }
        return view('dashboard');
    }

    public function logout(Request $request)
    {
        Session::forget('login');
        Session::forget('email');
        Session::forget('role');
        Session::forget('name');

        return redirect('/');
    }
}
