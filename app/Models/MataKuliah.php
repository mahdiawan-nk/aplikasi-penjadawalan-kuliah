<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramStudi;
use App\Models\Semester;

class MataKuliah extends Model
{
    use HasFactory;
    protected $fillable = ['kode_matkul','id_prodi','id_semester','nama_matkul','type_matkul','sks'];

    public function dataSemester()
    {
        return $this->hasOne(Semester::class, 'id', 'id_semester');
    }

    public function dataProdi()
    {
        return $this->hasOne(ProgramStudi::class, 'id', 'id_prodi');
    }
}
