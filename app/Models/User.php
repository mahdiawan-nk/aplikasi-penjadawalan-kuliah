<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ProgramStudi;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','id_prodi','nidn_nim','password','role','id_telegram'
    ];

    protected $hidden = [
        'password'
    ];

    public function dataProdi()
    {
        return $this->hasOne(ProgramStudi::class, 'id', 'id_prodi');
    }

}
