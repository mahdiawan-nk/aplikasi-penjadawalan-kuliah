<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Semester;

class Penjadwalan extends Model
{
    use HasFactory;
    protected $fillable = ['id_matkul','id_kelas','id_dosen','hari','jam_selesai','jam_mulai','rombel','data_prodi'];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    // SELECT a.id,a.id_matkul,CONCAT(b.kode_matkul,'-',b.nama_matkul)as matakuliah,e.periode,e.semester,c.nama_gedung,c.nama_kelas,c.kapasitas,b.sks,d.nama_dosen,CONCAT(a.jam_mulai,'-',a.jam_selesai)as jam,a.hari,a.rombel,a.data_prodi FROM penjadwalans a INNER JOIN mata_kuliahs b ON a.id_matkul=b.id INNER JOIN kelas c ON a.id_kelas=c.id INNER JOIN dosens d ON a.id_dosen=d.id INNER JOIN semesters e ON b.id_semester=e.id;
}
