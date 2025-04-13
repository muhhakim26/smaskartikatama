<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    use HasFactory, TimestampTrait;
    protected $table = 'tb_galeri_foto';
    protected $fillable = [
        'file_foto',
        'nama_foto',
    ];
}