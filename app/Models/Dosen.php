<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramStudi;

class Dosen extends Model
{
    use HasFactory;

    protected $fillable =['id_prodi','nidn','nama_dosen','email'];

    public function dataProdi()
    {
        return $this->hasOne(ProgramStudi::class, 'id', 'id_prodi');
    }
}
