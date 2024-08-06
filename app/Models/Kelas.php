<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penjadwalan;
use App\Models\PeminjamanKelas;
use Exception;
class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_gedung', 'nama_kelas', 'kapasitas'];


    public function jadwalKelas()
    {
        return $this->hasMany(PeminjamanKelas::class, 'id_kelas');
    }
    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class, 'id_kelas');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kelas) {
            $errorMessages = [];

            // Cek apakah ada adat istiadat terkait
            if ($kelas->jadwalKelas()->count() > 0) {
                $errorMessages[] = 'data Peminjaman Kelas terkait.';
            }

            // Cek apakah ada datouk ninik mamak terkait
            if ($kelas->penjadwalan()->count() > 0) {
                $errorMessages[] = 'data Penjadwalan Kelas terkait.';
            }

            // Lempar pengecualian jika terdapat pesan kesalahan
            if (!empty($errorMessages)) {
                throw new Exception(implode(' ', $errorMessages));
            }
        });
    }
}
