@extends('layouts.admin.preset')
@section('judul', 'Deskripsi PPDB Siswa')

@section('konten')
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
                                    <td>{{ $CalSis?->detailSiswa?->jenis_kelamin }}</td>
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
        <div class="col-md-7">
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="text-primary-light">Pas Foto Siswa</span></td>
                                    <td><a href="{{ route('berkas', $CalSis->detailSiswa?->fileft_siswa) }}"><iconify-icon icon="bx:file" width="24"></iconify-icon></a></td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_fileft_siswa === 'diproses')
                                            <p class="text text-danger">dalam proses</p>
                                        @elseif($CalSis?->detailSiswa?->status_fileft_siswa === 'diterima')
                                            <p class="text text-success">{{ $CalSis?->detailSiswa?->status_fileft_siswa }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_fileft_siswa === 'diproses')
                                            <div class="d-flex gap-1">
                                                <a class="terima-berkas" href="{{ route('kelola-ppdb.terima-berkas', ['nama_berkas' => 'foto_siswa', 'id' => $CalSis->id]) }}"><span class="badge fw-semibold bg-success-600 radius-4 px-20 py-9 text-sm text-white">Terima</span></a>
                                                <a class=""><span class="badge fw-semibold bg-danger-600 radius-4 px-20 py-9 text-sm text-white">Tolak</span></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-primary-light">Akta Kelahiran</span></td>
                                    <td><a href="{{ route('berkas', $CalSis->detailSiswa?->filefc_akte) }}"><iconify-icon icon="bx:file" width="24"></iconify-icon></a></td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_filefc_akte === 'diproses')
                                            <p class="text text-danger">dalam proses</p>
                                        @elseif($CalSis?->detailSiswa?->status_filefc_akte === 'diterima')
                                            <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_akte }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_filefc_akte === 'diproses')
                                            <div class="d-flex gap-1">
                                                <a class="terima-berkas" href="{{ route('kelola-ppdb.terima-berkas', ['nama_berkas' => 'file_akte', 'id' => $CalSis->id]) }}"><span class="badge fw-semibold bg-success-600 radius-4 px-20 py-9 text-sm text-white">Terima</span></a>
                                                <a class=""><span class="badge fw-semibold bg-danger-600 radius-4 px-20 py-9 text-sm text-white">Tolak</span></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-primary-light">Kartu Keluarga</span></td>
                                    <td><a href="{{ route('berkas', $CalSis->detailSiswa?->filefc_kk) }}"><iconify-icon icon="bx:file" width="24"></iconify-icon></a></td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_filefc_kk === 'diproses')
                                            <p class="text text-danger">dalam proses</p>
                                        @elseif($CalSis?->detailSiswa?->status_filefc_kk === 'diterima')
                                            <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_kk }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_filefc_kk === 'diproses')
                                            <div class="d-flex gap-1">
                                                <a class="terima-berkas" href="{{ route('kelola-ppdb.terima-berkas', ['nama_berkas' => 'file_kk', 'id' => $CalSis->id]) }}"><span class="badge fw-semibold bg-success-600 radius-4 px-20 py-9 text-sm text-white">Terima</span></a>
                                                <a class=""><span class="badge fw-semibold bg-danger-600 radius-4 px-20 py-9 text-sm text-white">Tolak</span></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-primary-light">Surat Keterangan Hasil Ujian</span></td>
                                    <td><a href="{{ route('berkas', $CalSis->detailSiswa?->filefc_skhu) }}"><iconify-icon icon="bx:file" width="24"></iconify-icon></a></td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_filefc_skhu === 'diproses')
                                            <p class="text text-danger">dalam proses</p>
                                        @elseif($CalSis?->detailSiswa?->status_filefc_skhu === 'diterima')
                                            <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_skhu }}</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($CalSis?->detailSiswa?->status_filefc_skhu === 'diproses')
                                            <div class="d-flex gap-1">
                                                <a class="terima-berkas" href="{{ route('kelola-ppdb.terima-berkas', ['nama_berkas' => 'file_skhu', 'id' => $CalSis->id]) }}"><span class="badge fw-semibold bg-success-600 radius-4 px-20 py-9 text-sm text-white">Terima</span></a>
                                                <a class=""><span class="badge fw-semibold bg-danger-600 radius-4 px-20 py-9 text-sm text-white">Tolak</span></a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @if (!empty($CalSis->detailSiswa?->filefc_skm))
                                    <tr>
                                        <td><span class="text-primary-light">Standar Kompetensi Mandiri</span></td>
                                        <td><a href="{{ route('berkas', $CalSis->detailSiswa?->filefc_skm) }}"><iconify-icon icon="bx:file"></iconify-icon></a></td>
                                        <td>
                                            @if ($CalSis?->detailSiswa?->status_filefc_skm === 'diproses')
                                                <p class="text text-danger">dalam proses</p>
                                            @elseif($CalSis?->detailSiswa?->status_filefc_skm === 'diterima')
                                                <p class="text text-success">{{ $CalSis?->detailSiswa?->status_filefc_skm }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($CalSis?->detailSiswa?->status_filefc_skm === 'diproses')
                                                <div class="d-flex gap-1">
                                                    <a class="terima-berkas" href="{{ route('kelola-ppdb.terima-berkas', ['nama_berkas' => 'file_skm', 'id' => $CalSis->id]) }}"><span class="badge fw-semibold bg-success-600 radius-4 px-20 py-9 text-sm text-white">Terima</span></a>
                                                    <a class=""><span class="badge fw-semibold bg-danger-600 radius-4 px-20 py-9 text-sm text-white">Tolak</span></a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @if (session()->has('message'))
        <script>
            Swal2.fire({
                icon: "success",
                title: "{{ session()->get('message') }}",
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('.terima-berkas').on('click', function(e) {
                e.preventDefault(); // Mencegah link berpindah halaman

                const url = $(this).attr('href'); // Ambil URL dari href
                const csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil CSRF token

                // Simpan posisi scroll ke localStorage
                localStorage.setItem('scrollPosition', window.scrollY);

                // Buat form POST secara dinamis
                const $form = $('<form>', {
                    action: url,
                    method: 'POST'
                });

                // Tambahkan input CSRF token
                $form.append($('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: csrfToken
                }));
                // Tambahkan method override
                $form.append($('<input>', {
                    type: 'hidden',
                    name: '_method',
                    value: 'PUT'
                }));
                // Tambahkan ke body dan submit
                $form.appendTo('body').submit();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            const scrollPosition = localStorage.getItem('scrollPosition');
            if (scrollPosition !== null) {
                window.scrollTo({
                    top: parseInt(scrollPosition),
                    behavior: 'smooth'
                });
                localStorage.removeItem('scrollPosition');
            }
        });
    </script>
@endpush
