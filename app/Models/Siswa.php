<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'siswa';
    protected $table = 'siswa';

    protected $fillable = [
        'id_pendaftaran',
        'gelombang_pendaftaran',
        'tahun_ajaran',
        'email',
        'nama',
        'nhp_siswa',
        'nisn',
        'level',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function detailSiswa()
    {
        return $this->hasOne(DetailSiswa::class, 'siswa_id', 'id');
    }

    public function progresSiswa()
    {
        return $this->hasOne(ProgresSiswa::class, 'siswa_id', 'id');
    }
}
