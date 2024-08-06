<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramStudi;
use App\Models\Penjadwalan;
use Exception;
class KelasMahasiswa extends Model
{
    use HasFactory;
    protected $fillable = ['id_program_study','nama_kelas','jumlah_mahasiswa'];

    public function programstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_program_study');
    }

    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class, 'rombel');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($KelasMahasiswa) {
            $errorMessages = [];

            if ($KelasMahasiswa->penjadwalan()->count() > 0) {
                $errorMessages[] = ' Penjadwalan Kelas.';
            }

            // Lempar pengecualian jika terdapat pesan kesalahan
            if (!empty($errorMessages)) {
                throw new Exception(implode(' ', $errorMessages));
            }
        });
    }
}
