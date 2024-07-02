<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    use HasFactory, TimestampTrait;
    protected $table = 'data_guru';
    protected $fillable = [
        'nip',
        'nama',
        'file_foto',
        'bidang',
        'jabatan',
    ];
}
