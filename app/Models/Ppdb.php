<?php

namespace App\Models;

use App\Models\Area\District;
use App\Models\Area\Province;
use App\Models\Area\Regency;
use App\Models\Area\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    use HasFactory;
    protected $table = 'ppdb';
    protected $fillable = [
        'id_pendaftaran',
        'nama',
        'jenis_kelamin',
        'nisn',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'brkthn_khusus_siswa',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_kelurahan_id',
        'kode_pos',
        'alamat',
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
    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'provinsi_id', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Regency::class, 'kabupaten_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'kecamatan_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Village::class, 'desa_kelurahan_id', 'id');
    }
}
