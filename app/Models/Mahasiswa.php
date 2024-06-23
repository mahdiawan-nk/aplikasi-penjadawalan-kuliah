<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramStudi;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable =['id_prodi','semester','nim','email','nama','kelas','alamat','telp','jenis_kelamin','is_update'];

    public function dataProdi()
    {
        return $this->hasOne(ProgramStudi::class, 'id', 'id_prodi');
    }
}
