<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'tb_berita';

    protected $fillable = [
        'judul',
        'file_foto',
        'kutipan',
        'deskripsi',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];
}
