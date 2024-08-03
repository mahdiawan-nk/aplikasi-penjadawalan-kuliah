<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAkademik;

class Semester extends Model
{
    use HasFactory;
    protected $fillable =['id_tahun_akademik','periode','semester'];

    public function tahunakademik()
    {
        return $this->belongsTo(TahunAkademik::class,'id_tahun_akademik');
    }
}
