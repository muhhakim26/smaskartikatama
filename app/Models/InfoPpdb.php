<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPpdb extends Model
{
    use HasFactory;
    protected $table = 'tb_info_ppdb';
    protected $fillable = [
        'id',
        'deskripsi',
    ];
}
