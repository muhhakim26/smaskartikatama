<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory;

    protected $table = 'tb_galeri_video';

    protected $fillable = [
        'thumbnail',
        'file_video',
        'judul_video',
    ];
}
