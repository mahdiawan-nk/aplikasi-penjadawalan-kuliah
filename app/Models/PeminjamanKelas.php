<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
class PeminjamanKelas extends Model
{
    use HasFactory;

    protected $fillable =['id_user','id_kelas','id_jadwal','id_dosen','hari','jam_mulai','jam_selesai','keterangan','jenis_request','status_admin','status_penggunaan'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
