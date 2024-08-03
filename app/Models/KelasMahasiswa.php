<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramStudi;

class KelasMahasiswa extends Model
{
    use HasFactory;
    protected $fillable = ['id_program_study','nama_kelas','jumlah_mahasiswa'];

    public function programstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_program_study');
    }
}
