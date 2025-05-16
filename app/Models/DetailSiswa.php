<?php

namespace App\Models;

use App\Models\Area\District;
use App\Models\Area\Province;
use App\Models\Area\Regency;
use App\Models\Area\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSiswa extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_siswa';
    protected $primaryKey = 'siswa_id';

    protected $fillable = [
        'siswa_id',
        // 'id_pendaftaran',
        // 'nama',
        'provinsi_id',
        'jenis_kelamin',
        'kabupaten_id',
        // 'nisn',
        'kecamatan_id',
        'tempat_lahir',
        'desa_kelurahan_id',
        'tgl_lahir',
        'kode_pos',
        'agama',
        // 'email',
        'asal_sekolah',
        // 'nhp_siswa',
        'alamat',
        'nama_ayah',
        'pend_terakhir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nhp_ayah',
        'nama_ibu',
        'pend_terakhir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'nhp_ibu',
        'info_pendaftaran',
        'fileft_siswa',
        'status_fileft_siswa',
        'filefc_akte',
        'status_filefc_akte',
        'filefc_kk',
        'status_filefc_kk',
        'filefc_skhu',
        'status_filefc_skhu',
        'filefc_skm',
        'status_filefc_skm',
        'status_berkas',
        'status_siswa'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function getInfoPendaftaranAttribute($value)
    {
        return explode(',', $value);
    }

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