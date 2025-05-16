<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'tb_ekstrakurikuler';

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto_struktur',
        'foto_kegiatan',
    ];
}
