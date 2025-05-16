<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GelombangPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'tb_gelombang_pendaftaran';

    protected $fillable = ['tahun_ajaran', 'kuota_pendaftaran', 'tanggal_dibuka', 'tanggal_ditutup', 'tanggal_diumumkan', 'catatan', 'link_grup', 'status_pendaftaran', 'status_pengumuman'];
}
