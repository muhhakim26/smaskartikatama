<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pendaftaran',
        'nama',
        'jenis_kelamin',
        'nisn',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'brkthn_khusus_siswa',
        'alamat',
        'desa_kelurahan',
        'kecamatan',
        'kode_pos',
        'nhp_ortu',
        'nhp_siswa',
        'email',
        'asal_sekolah',
        'nama_ayah',
        'pend_terakhir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'brkthn_khusus_ayah',
        'nama_ibu',
        'pend_terakhir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'brkthn_khusus_ibu',
        'nama_wali',
        'jenis_kelamin_wali',
        'pend_terakhir_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'brkthn_khusus_wali',
        'filefc_akte',
        'filefc_kk',
        'filefc_skhu',
        'filefc_skm',
    ];
}
