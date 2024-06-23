<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penjadwalan;
use App\Models\PeminjamanKelas;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable=['nama_gedung','nama_kelas','kapasitas'];


    public function jadwalKelas()
    {
        return $this->hasMany(PeminjamanKelas::class, 'id_kelas');
    }
}
