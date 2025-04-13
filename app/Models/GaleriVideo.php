<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory,TimestampTrait;
    protected $table = 'tb_galeri_video';
    protected $fillable = [
        'thumbnail',
        'file_video',
        'judul_video',
    ];
}