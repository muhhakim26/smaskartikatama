<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanKepsek extends Model
{
    use HasFactory;
    protected $table = 'tb_sambutan_kepsek';
    protected $fillable = [
        'id',
        'deskripsi',
    ];
}