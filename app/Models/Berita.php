<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory, TimestampTrait;
    protected $table = 'berita';
    protected $fillable = [
        'judul',
        'file_foto',
        'deskripsi',
    ];
}
