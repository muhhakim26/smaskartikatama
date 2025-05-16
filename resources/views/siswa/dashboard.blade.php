@extends('layouts.siswa.preset')
@section('judul', 'Dashboard')
@section('konten')
    <div class="mb-40">
        <div class="row g-3">
            <div class="col-md-3">
                <span class="btn {{ $ProSis?->step_1 ? 'btn-primary-600' : 'disabled' }} w-100">
                    <h6 class="{{ $ProSis?->step_1 ? 'text-base' : '' }} text-lg">Langkah 1 <i class="{{ $ProSis?->step_1 ? 'ri-check-line' : 'ri-indeterminate-circle-line' }}"></i></h6>
                    <p>Isi dan Lengkapi Formulir</p>
                </span>
            </div>
            <div class="col-md-3">
                <span class="btn {{ $ProSis?->step_2 ? 'btn-primary-600' : 'disabled' }} w-100">
                    <h6 class="{{ $ProSis?->step_2 ? 'text-base' : '' }} text-lg">Langkah 2 <i class="{{ $ProSis?->step_2 ? 'ri-check-line' : 'ri-indeterminate-circle-line' }}"></i></h6>
                    <p>Masuk Grup WA</p>
                </span>
            </div>
            <div class="col-md-3">
                <span class="btn {{ $ProSis?->step_3 ? 'btn-primary-600' : 'disabled' }} w-100">
                    <h6 class="{{ $ProSis?->step_3 ? 'text-base' : '' }} text-lg">Langkah 3 <i class="{{ $ProSis?->step_3 ? 'ri-check-line' : 'ri-indeterminate-circle-line' }}"></i></h6>
                    <p>Validasi Berkas</p>
                </span>
            </div>
            <div class="col-md-3">
                <span class="btn {{ $ProSis?->step_4 ? 'btn-primary-600' : 'disabled' }} w-100">
                    <h6 class="{{ $ProSis?->step_4 ? 'text-base' : '' }} text-lg">Langkah 4 <i class="{{ $ProSis?->step_4 ? 'ri-check-line' : 'ri-indeterminate-circle-line' }}"></i></h6>
                    <p>Pengumuman Hasil</p>
                </span>
            </div>
        </div>
    </div>
    @if ($ProSis?->step_1 !== 1)
        <div class="row gy-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Lengkapi Data Diri!</h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text font-weight-bold mb-4">👉 Klik "Lengkapi Data" dan mulai langkahmu hari ini!</p>
                        <a class="btn btn-primary mt-1" href="{{ route('siswa.edit', auth()->user()->id) }}">Lengkapi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($ProSis?->step_1 === 1 && $ProSis?->step_2 !== 1 && $ProSis?->step_3 !== 1 && $ProSis?->step_4 !== 1)
        <div class="row gy-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Profil Calon Peserta Didik</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-borderless mb-0 table">
                                <tbody>
                                    <tr>
                                        <td>Gelombang Pendaftaran</td>
                                        <td>:</td>
                                        <td><strong>Batch {{ $CalSis?->gelombang_pendaftaran }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Ajaran</td>
                                        <td>:</td>
                                        <td><strong>{{ $CalSis?->tahun_ajaran }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>No Pendaftaran</td>
                                        <td>:</td>
                                        <td><strong>{{ $CalSis?->id_pendaftaran }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>NISN</td>
                                        <td>:</td>
                                        <td><strong>{{ $CalSis?->nisn }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>:</td>
                                        <td><strong>{{ $CalSis?->nama }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. HP Siswa</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->nhp_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->agama }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->tgl_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Asal Sekolah</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->asal_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Provinsi</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->provinsi?->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kabupaten</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->kabupaten?->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->kecamatan?->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Desa/Keluarahn</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->kelurahan?->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Info Pendaftaran</td>
                                        <td>:</td>
                                        <td>{{ implode(', ', $CalSis->detailSiswa->info_pendaftaran ?? []) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Profil Orang Tua</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-borderless mb-0 table">
                                <tbody>
                                    <tr>
                                        <td>Nama Ayah</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->nama_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan Terkahir</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->pend_terakhir_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->pekerjaan_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penghasilan</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->penghasilan_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. HP Ayah</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->nhp_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Ibu</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->nama_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pendidikan Terkahir</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->pend_terakhir_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->pekerjaan_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penghasilan</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->penghasilan_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. HP Ibu</td>
                                        <td>:</td>
                                        <td>{{ $CalSis?->detailSiswa?->nhp_ibu }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Berkas yang Terupload</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-borderless table-sm mb-0 table">
                                <thead>
                                    <tr>
                                        <th>Berkas</th>
                                        <th>File</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="text-primary-light">Pas Foto Siswa</span></td>
                                        <td><iconify-icon icon="bx:file" width="24"></iconify-icon>{{ $CalSis?->detailSiswa?->fileft_siswa }}</td>
                                        <td>
                                            @if ($CalSis?->detailSiswa?->status_fileft_siswa === 'diproses')
                                                <p class="text text-danger">dalam proses</p>
                                            @elseif($CalSis?->detailSiswa?->status_fileft_siswa === 'diterima')
                                                <p class="text text-success">{{ $CalSis?->detailSiswa?->status_fileft_siswa }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-primary-light">Akta Kelahiran</span></td>
                                        <td><iconify-icon icon="bx:file" width="24"></iconify-icon>{{ $CalSis?->detailSiswa?->filefc_akte }}</td>
                                        <td>
                                            @if ($CalSis?->detailSiswa?->status_filefc_akte === 'diproses')
                                                <p class="text text-danger">dalam proses</p>
                                            @elseif($CalSis?->detailSiswa?->status_filefc_akte === 'diterima')
                                                <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_akte }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-primary-light">Kartu Keluarga</span></td>
                                        <td><iconify-icon icon="bx:file"></iconify-icon>{{ $CalSis?->detailSiswa?->filefc_kk }}</td>
                                        <td>
                                            @if ($CalSis?->detailSiswa?->status_filefc_kk === 'diproses')
                                                <p class="text text-danger">dalam proses</p>
                                            @elseif($CalSis?->detailSiswa?->status_filefc_kk === 'diterima')
                                                <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_kk }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-primary-light">Surat Keterangan Hasil Ujian</span></td>
                                        <td><iconify-icon icon="bx:file"></iconify-icon>{{ $CalSis?->detailSiswa?->filefc_skhu }}</td>
                                        <td>
                                            @if ($CalSis?->detailSiswa?->status_filefc_skhu === 'diproses')
                                                <p class="text text-danger">dalam proses</p>
                                            @elseif($CalSis?->detailSiswa?->status_filefc_skhu === 'diterima')
                                                <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_skhu }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-primary-light">Standar Kompetensi Mandiri</span></td>
                                        <td><iconify-icon icon="bx:file"></iconify-icon>{{ $CalSis?->detailSiswa?->filefc_skm }}</td>
                                        <td>
                                            @if ($CalSis?->detailSiswa?->status_filefc_skm === 'diproses')
                                                <p class="text text-danger">dalam proses</p>
                                            @elseif($CalSis?->detailSiswa?->status_filefc_skm === 'diterima')
                                                <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_skm }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($ProSis?->step_2 === 1 && ($ProSis?->step_3 === 1 || $ProSis?->step_3 !== 1) && $ProSis?->step_4 !== 1)
        <div class="row gy-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Masuk Grub Whatsapp</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info bg-info-600 border-info-600 fw-semibold radius-8 mb-0 px-24 py-11 text-lg text-white" role="alert">
                            <h5 class="text-white">Terima Kasih Telah Melengkapi Data</h5>
                            <p>Silakan masuk ke grup melalui link berikut untuk informasi lebih lanjut: <a class="btn btn-warning fw-bold text-white" href="{{ $Gelombang?->link_grup ?? '#' }}" target="_blank">Gabung Grup</a></p>
                        </div>
                        <br>
                        <div class="alert alert-primary bg-primary-600 border-primary-600 fw-semibold radius-8 d-flex align-items-center justify-content-between mb-0 px-24 py-11 text-lg text-white" role="alert">
                            <p>Pengumuman terkait Penerimaan Peserta Didik Baru (PPDB) untuk tahun ajaran {{ $Gelombang?->tahun_ajaran }} akan disampaikan pada tanggal <span class="badge fw-semibold text-warning-600 bg-warning-100 radius-4 px-20 py-9 text-sm text-white">{{ \Carbon\Carbon::parse($Gelombang?->tanggal_diumumkan)->translatedFormat('l, d F Y') }}</span>.<br>Pantau terus website resmi kami untuk mendapatkan informasi terbaru.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($ProSis?->step_4 === 1)
        <div class="row gy-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Pemberitahuan</h6>
                    </div>
                    <div class="card-body">
                        @if ($Gelombang?->status_pengumuman === 1)
                            <div class="alert alert-success bg-success-600 border-success-600 fw-semibold radius-8 mb-0 px-24 py-11 text-lg text-white" role="alert">
                                <h5 class="text-white">Hasil Pengumuman PPDB Tahun Ajaran {{ $CalSis?->tahun_ajaran }}</h5>
                                <h5>Anda telah dinyatakan <strong>Diterima</strong></h5>
                                <p class="fw-medium">Terima kasih telah mengikuti proses PPDB di Nama Sekolah.</p>
                            </div>
                        @else
                            <div class="alert alert-primary bg-primary-600 border-primary-600 fw-semibold radius-8 d-flex align-items-center justify-content-between mb-0 px-24 py-11 text-lg text-white" role="alert">
                                <p class="font-weight-bold">Belum ada informasi pengumuman PPDB saat ini.<br>Silakan cek kembali dalam waktu dekat di website resmi kami.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endif
@endsection
