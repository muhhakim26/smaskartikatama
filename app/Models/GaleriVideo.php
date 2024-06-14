<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'thumbnail',
        'file_video',
        'judul_video',
    ];
}
