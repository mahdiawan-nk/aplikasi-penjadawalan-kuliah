<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanKelas;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use function App\Helpers\decrypt;
use function App\Helpers\encrypt;
use function App\Helpers\infoUser;
use function App\Helpers\TelegramSend;
use App\Events\NotifEvent;
use App\Models\Notification as notif;


class PeminjamanKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        if (request()->ajax() || $request->input('ajax')) {
            $data = PeminjamanKelas::with('kelas');
            if (session('role') == 4) {
                $data->where('id_user', $this->getUserId());
            }
            $data->orderBy('id', 'desc')->get();
            $dataTable = DataTables::of($data);
            $dataTable->addIndexColumn()
                ->addColumn('uid', function ($row) {
                    return encrypt($row->id);
                })
                ->addColumn('user_request', function ($row) {
                    return infoUser($row->id_user)->name;
                })
                ->addColumn('jam_pemakaian', function ($row) {
                    return $row->jam_mulai . ' - ' . $row->jam_selesai;
                })
                ->addColumn('log_date', function ($row) {
                    return [
                        'date' => Carbon::parse($row->created_at)->format('d/M/Y'),
                        'jam' => Carbon::parse($row->created_at)->format('H:i')
                    ];
                })
                ->filterColumn('kelas', function ($row) use ($request) {
                    if ($keyword = $request->input('search.value')) {
                        return $row->whereHas('kelas', function ($subquery) use ($keyword) {
                            return $subquery->where('nama_kelas', 'LIKE', '%' . $keyword . '%');
                        });
                    }
                    return $row;
                })
                ->rawColumns(['uid', 'user_request', 'jam_pemakaian', 'log_date']);

            return $dataTable->make(true);
        }
        return view('peminjaman.index');
    }

    private function getUserId()
    {
        $dataUser = User::where('email', session('email'))->first()->id;

        return $dataUser;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($peminjaman = null)
    {
        if ($peminjaman != null) {
            $id = decrypt($peminjaman);
            $dataJadwal = Kelas::where('id', $id)->first()->id;
        } else {
            $id = $peminjaman;
            $dataJadwal = null;
        }


        return view('peminjaman.form_konfirmasi', ['data' => $dataJadwal, 'status' => 0]);
        // return response()->json($id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataPost = $request->input();
        $dataPost['id_user'] = infoUser()->id;

        PeminjamanKelas::create($dataPost);

        $userReceiver = User::where('role', 1)->first()->id;

        $senderUser = infoUser()->id;
        $receiverUser = $userReceiver;

        TelegramSend($senderUser, $receiverUser, infoUser($receiverUser)->role, ['keterangan' => $dataPost['keterangan'], 'status_admin' => $dataPost['status_admin'], 'status_penggunaan' => $dataPost['status_penggunaan']]);
        return response()->json($dataPost);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeminjamanKelas  $peminjamanKelas
     * @return \Illuminate\Http\Response
     */
    public function show($peminjaman)
    {
        $id = decrypt($peminjaman);
        $dataJadwal = PeminjamanKelas::where('id', $id)->first();

        return view('peminjaman.form_edit_konfirmasi', ['data' => $dataJadwal, 'status' => 0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeminjamanKelas  $peminjamanKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(PeminjamanKelas $peminjamanKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeminjamanKelas  $peminjamanKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeminjamanKelas $peminjaman)
    {
        if (infoUser()->role == 4) {
            $userReceiver = User::where('role', 1)->first()->id;
        } else {
            $userReceiver = $peminjaman->id_user;
        }

        $peminjaman->fill($request->all())->save();

        $data = [
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $request->all()
        ];

        $senderUser = infoUser()->id;
        $receiverUser = $userReceiver;

        TelegramSend($senderUser, $receiverUser, infoUser($receiverUser)->role, ['keterangan' => null, 'status_admin' => $request->status_admin, 'status_penggunaan' => $request->status_penggunaan]);
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeminjamanKelas  $peminjamanKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeminjamanKelas $peminjamanKelas)
    {
        //
    }
}
