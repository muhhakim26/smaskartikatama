<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;
    protected $table = 'tb_sejarah';
    protected $fillable = [
        'id',
        'deskripsi',
    ];
}