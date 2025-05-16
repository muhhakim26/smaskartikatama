<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresSiswa extends Model
{
    use HasFactory;

    protected $table = 'tb_progres_siswa';
    protected $primaryKey = 'siswa_id';
    protected $fillable = ['siswa_id', 'step_1', 'step_2', 'step_3', 'step_4'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}