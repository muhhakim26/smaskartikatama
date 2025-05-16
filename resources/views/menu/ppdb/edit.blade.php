@extends('layouts.admin.preset')
@section('judul', 'Edit PPDB Siswa')

@section('konten')
    <!-- PPDB Section -->
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0">Edit Form Peserta Didik {{ $CalSis?->nisn }} Gelombang {{ $CalSis?->gelombang_pendaftaran }} Tahun Ajaran {{ $CalSis?->tahun_ajaran }}</h6>
                </div>
                <div class="card-body">
                    {{-- blade-formatter-disable --}}
                        @if (session()->has('message'))
                            <div @class(['font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'alert alert-danger' => session()->get('hasError'),])>
                                {{ session()->get('message') }}
                            </div>
                            @if ($errors->any())
                        <div class="pt-3">
                            <div class="alert alert-danger text-capitalize">
                                <p>Lengkapi Data!</p>
                                <ul class="pt-10" style="list-style:none;">
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                        @endif
                    {{-- blade-formatter-enable --}}
                    <form action="{{ route('kelola-ppdb.update', $CalSis->id) }}" enctype="multipart/form-data" id="ppdb-form" method="post">
                        @csrf
                        @method('put')
                        <div class="py-32">
                            <h6 class="mb-20">Data Calon Siswa</h6>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="nomor-pendaftaran-siswa">Nomor Pendaftaran</label>
                                    <input class="form-control @error('nomor-pendaftaran-siswa') is-invalid @enderror" id="nomor-pendaftaran-siswa" name="nomor-pendaftaran-siswa" readonly type="text" value="{{ old('nomor-pendaftaran-siswa', $CalSis->id_pendaftaran) }}">
                                    @error('nomor-pendaftaran-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nisn-siswa">NISN</label>
                                    <input class="form-control @error('nisn-siswa') is-invalid @enderror" id="nisn-siswa" name="nisn-siswa" onkeypress="return hanyaAngka(event)" required type="text" value="{{ old('nisn-siswa', $CalSis->nisn) }}">
                                    @error('nisn-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="nama-siswa">Nama</label>
                                    <input class="form-control @error('nama-siswa') is-invalid @enderror" id="nama-siswa" name="nama-siswa" placeholder="Nama" type="text" value="{{ old('nama-siswa', $CalSis->nama) }}">
                                    @error('nama-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="provinsi-siswa">Provinsi</label>
                                    <select class="form-select @error('provinsi-siswa') is-invalid @enderror" id="provinsi-siswa" name="provinsi-siswa">
                                        <option disabled selected value="">Pilih...</option>
                                        @foreach ($Provinsi as $value)
                                            <option @selected(old('provinsi-siswa', $CalSis->detailSiswa?->provinsi_id) == $value->id) value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label @error('jenis-kelamin-siswa') is-invalid @enderror">Jenis Kelamin</label>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('jenis-kelamin-siswa', $CalSis->detailSiswa?->jenis_kelamin) === 'laki-laki') class="form-check-input" id="laki-laki" name="jenis-kelamin-siswa" type="radio" value="laki-laki">
                                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('jenis-kelamin-siswa', $CalSis->detailSiswa?->jenis_kelamin) === 'perempuan') class="form-check-input" id="perempuan" name="jenis-kelamin-siswa" type="radio" value="perempuan">
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                    @error('jenis-kelamin-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="kabupaten-siswa">Kabupaten</label>
                                    <select class="form-select @error('kabupaten-siswa') is-invalid @enderror" id="kabupaten-siswa" name="kabupaten-siswa">
                                        <option disabled selected value="">Pilih...</option>
                                        @if (!empty($Kabupaten) || session()->has('Kabupaten'))
                                            @foreach (session('Kabupaten', $Kabupaten ?? collect()) as $key => $value)
                                                <option @selected(old('kabupaten-siswa', $CalSis->detailSiswa?->kabupaten_id) == $key) value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kabupaten-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="kecamatan-siswa">Kecamatan</label>
                                    <select class="form-select @error('kecamatan-siswa') is-invalid @enderror" id="kecamatan-siswa" name="kecamatan-siswa">
                                        <option disabled selected value="">Pilih...</option>
                                        @if (!empty($Kecamatan) || session()->has('Kecamatan'))
                                            @foreach (session('Kecamatan', $Kecamatan ?? collect()) as $key => $value)
                                                <option @selected(old('kecamatan-siswa', $CalSis->detailSiswa?->kecamatan_id) == $key) value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kecamatan-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="tempat-lahir-siswa">Tempat Lahir</label>
                                    <input class="form-control @error('tempat-lahir-siswa') is-invalid @enderror" id="tempat-lahir-siswa" name="tempat-lahir-siswa" placeholder="Tempat Lahir" type="text" value="{{ old('tempat-lahir-siswa', $CalSis->detailSiswa?->tempat_lahir) }}">
                                    @error('tempat-lahir-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="desa-kelurahan-siswa">Desa/Kelurahan</label>
                                    <select class="form-select @error('desa-kelurahan-siswa') is-invalid @enderror" id="desa-kelurahan-siswa" name="desa-kelurahan-siswa">
                                        <option disabled selected value="">Pilih...</option>
                                        @if (!empty($Kelurahan) || session()->has('Kelurahan'))
                                            @foreach (session('Kelurahan', $Kelurahan ?? collect()) as $key => $value)
                                                <option @selected(old('desa-kelurahan-siswa', $CalSis->detailSiswa?->desa_kelurahan_id) == $key) value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('desa-kelurahan-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="tanggal-lahir-siswa">Tanggal Lahir</label>
                                    <input class="form-control @error('tanggal-lahir-siswa') is-invalid @enderror" id="tanggal-lahir-siswa" name="tanggal-lahir-siswa" placeholder="Tanggal Lahir" type="date" value="{{ old('tanggal-lahir-siswa', $CalSis->detailSiswa?->tgl_lahir) }}"">
                                    @error('tanggal-lahir-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="kode-pos-siswa">Kode POS</label>
                                    <input class="form-control @error('kode-pos-siswa') is-invalid @enderror" id="kode-pos-siswa" name="kode-pos-siswa" onkeypress="return hanyaAngka(event)" placeholder="Kode POS" type="text" value="{{ old('kode-pos-siswa', $CalSis->detailSiswa?->kode_pos) }}">
                                    @error('kode-pos-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label @error('agama-siswa') is-invalid @enderror">Agama</label>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $CalSis->detailSiswa?->agama) === 'buddha') class="form-check-input" id="buddha" name="agama-siswa" type="radio" value="buddha">
                                        <label class="form-check-label" for="buddha">Buddha</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $CalSis->detailSiswa?->agama) === 'hindu') class="form-check-input" id="hindu" name="agama-siswa" type="radio" value="hindu">
                                        <label class="form-check-label" for="hindu">Hindu</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $CalSis->detailSiswa?->agama) === 'khonghucu') class="form-check-input" id="khonghucu" name="agama-siswa" type="radio" value="khonghucu">
                                        <label class="form-check-label" for="khonghucu">Khonghucu</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $CalSis->detailSiswa?->agama) === 'kristen_katolik') class="form-check-input" id="katolik" name="agama-siswa" type="radio" value="kristen_katolik">
                                        <label class="form-check-label" for="katolik">Katolik</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $CalSis->detailSiswa?->agama) === 'kristen_protestan') class="form-check-input" id="protestan" name="agama-siswa" type="radio" value="kristen_protestan">
                                        <label class="form-check-label" for="protestan">Protestan</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $CalSis->detailSiswa?->agama) === 'islam') class="form-check-input" id="islam" name="agama-siswa" type="radio" value="islam">
                                        <label class="form-check-label" for="islam">Islam</label>
                                    </div>
                                    @error('agama-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="email-siswa">Email</label>
                                    <input class="form-control @error('email-siswa') is-invalid @enderror" id="email-siswa" name="email-siswa" placeholder="Email" type="email" value="{{ old('email-siswa', $CalSis->email) }}">
                                    @error('email-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="asal-sekolah-siswa">Asal Sekolah SMP/Mts</label>
                                    <input class="form-control @error('asal-sekolah-siswa') is-invalid @enderror" id="asal-sekolah-siswa" name="asal-sekolah-siswa" placeholder="Asal Sekolah" type="text" value="{{ old('asal-sekolah-siswa', $CalSis->detailSiswa?->asal_sekolah) }}">
                                    @error('asal-sekolah-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="no-hp-siswa">Nomor HP</label>
                                    <input class="form-control @error('no-hp-siswa') is-invalid @enderror" id="no-hp-siswa" name="no-hp-siswa" onkeypress="return hanyaAngka(event)" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" type="tel" value="{{ old('no-hp-siswa', $CalSis->nhp_siswa) }}">
                                    @error('no-hp-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="alamat-siswa">Alamat</label>
                                    <textarea class="form-control @error('alamat-siswa') is-invalid @enderror" id="alamat-siswa" name="alamat-siswa" placeholder="Alamat" rows="3">{{ old('alamat-siswa', $CalSis->detailSiswa?->alamat) }}</textarea>
                                    @error('alamat-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="py-32">
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <h6 class="mb-20">Data Ayah</h6>
                                    <div class="mb-20">
                                        <label class="form-label" for="nama-ayah-siswa">Nama Lengkap</label>
                                        <input class="form-control @error('nama-ayah-siswa') is-invalid @enderror" id="nama-ayah-siswa" name="nama-ayah-siswa" placeholder="Nama" type="text"value="{{ old('nama-ayah-siswa', $CalSis->detailSiswa?->nama_ayah) }}">
                                        @error('nama-ayah-siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pendidikan-terakhir-ayah">Pendidikan Terakhir</label>
                                        <input class="form-control @error('pendidikan-terakhir-ayah') is-invalid @enderror" id="pendidikan-terakhir-ayah" name="pendidikan-terakhir-ayah" placeholder="Pendidikan Terakhir" type="text" value="{{ old('pendidikan-terakhir-ayah', $CalSis->detailSiswa?->pend_terakhir_ayah) }}">
                                        @error('pendidikan-terakhir-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pekerjaan-ayah">Pekerjaan</label>
                                        <input class="form-control @error('pekerjaan-ayah') is-invalid @enderror" id="pekerjaan-ayah" name="pekerjaan-ayah" placeholder="Pekerjaan" type="text" value="{{ old('pekerjaan-ayah', $CalSis->detailSiswa?->pekerjaan_ayah) }}">
                                        @error('pekerjaan-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="penghasilan-ayah">Penghasilan (Perbulan)</label>
                                        <input class="form-control rupiah @error('penghasilan-ayah') is-invalid @enderror" id="penghasilan-ayah" name="penghasilan-ayah" onkeypress="return hanyaAngka(event)" placeholder="Penghasilan" type="text" value="{{ old('penghasilan-ayah', $CalSis->detailSiswa?->penghasilan_ayah ?? 'Rp. 0') }}">
                                        @error('penghasilan-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="no-hp-ayah">No HP</label>
                                        <input class="form-control @error('no-hp-ayah') is-invalid @enderror" id="no-hp-ayah" name="no-hp-ayah" onkeypress="return hanyaAngka(event)" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" type="tel" value="{{ old('no-hp-ayah', $CalSis->detailSiswa?->nhp_ayah) }}">
                                        @error('no-hp-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-20">Data Ibu</h6>
                                    <div class="mb-20">
                                        <label class="form-label" for="nama-ibu-siswa">Nama Lengkap</label>
                                        <input class="form-control @error('nama-ibu-siswa') is-invalid @enderror" id="nama-ibu-siswa" name="nama-ibu-siswa" placeholder="Nama" type="text" value="{{ old('nama-ibu-siswa', $CalSis->detailSiswa?->nama_ibu) }}">
                                        @error('nama-ibu-siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pendidikan-terakhir-ibu">Pendidikan Terakhir</label>
                                        <input class="form-control @error('pendidikan-terakhir-ibu') is-invalid @enderror" id="pendidikan-terakhir-ibu" name="pendidikan-terakhir-ibu" placeholder="Pendidikan Terakhir" type="text" value="{{ old('pendidikan-terakhir-ibu', $CalSis->detailSiswa?->pend_terakhir_ibu) }}">
                                        @error('pendidikan-terakhir-ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pekerjaan-ibu">Pekerjaan</label>
                                        <input class="form-control @error('pekerjaan-ibu') is-invalid @enderror" id="pekerjaan-ibu" name="pekerjaan-ibu" placeholder="Pekerjaan" type="text" value="{{ old('pekerjaan-ibu', $CalSis->detailSiswa?->pekerjaan_ibu) }}">
                                        @error('pekerjaan-ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="penghasilan-ibu">Penghasilan (Perbulan)</label>
                                        <input class="form-control rupiah @error('penghasilan-ibu') is-invalid @enderror" id="penghasilan-ibu" name="penghasilan-ibu" onkeypress="return hanyaAngka(event)" placeholder="Penghasilan" type="text" value="{{ old('penghasilan-ibu', $CalSis->detailSiswa?->penghasilan_ibu ?? 'Rp. 0') }}">
                                        @error('penghasilan-ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="no-hp-ibu">No HP</label>
                                        <input class="form-control @error('no-hp-ibu') is-invalid @enderror" id="no-hp-ibu" name="no-hp-ibu" onkeypress="return hanyaAngka(event)" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" type="tel" value="{{ old('no-hp-ibu', $CalSis->detailSiswa?->nhp_ibu) }}">
                                        @error('no-hp-ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-32">
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <h6 class="mb-20">File</h6>
                                    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 py-13 fw-semibold radius-4 d-flex align-items-center justify-content-between mb-0 px-24 text-lg" role="alert">
                                        <div class="d-flex align-items-center gap-2">
                                            <iconify-icon icon="material-symbols:info"></iconify-icon>
                                            <p class="mb-0 text-sm">Upload berkas sesuai dengan syarat dan ketentuan dengan format jpg, jpeg, png dan maksimal 3MB</p>
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-ft-siswa">Foto 3x4</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control @error('file-ft-siswa') is-invalid @enderror" id="file-ft-siswa" name="file-ft-siswa" onchange="imagePreviewFunc(this, imagePreview_1)" type="file">
                                        @error('file-ft-siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_1">
                                            @if ($CalSis?->detailSiswa?->fileft_siswa)
                                                <img alt="Foto Siswa {{ $CalSis->nama }}" src="{{ route('siswa.berkas', $CalSis->detailSiswa?->fileft_siswa) }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-akte">Scan Akta Kelahiran</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control @error('file-akte') is-invalid @enderror" id="file-akte" name="file-akte" onchange="imagePreviewFunc(this, imagePreview_2)" type="file">
                                        @error('file-akte')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_2">
                                            @if ($CalSis?->detailSiswa?->filefc_akte)
                                                <img alt="Akte {{ $CalSis->nama }}" src="{{ route('siswa.berkas', $CalSis->detailSiswa?->filefc_akte) }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-kk">Scan Kartu Keluarga</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control @error('file-kk') is-invalid @enderror" id="file-kk" name="file-kk" onchange="imagePreviewFunc(this, imagePreview_3)" type="file">
                                        @error('file-kk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_3">
                                            @if ($CalSis?->detailSiswa?->filefc_kk)
                                                <img alt="KK {{ $CalSis->nama }}" src="{{ route('siswa.berkas', $CalSis->detailSiswa?->filefc_kk) }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-skhu">Scan Surat Keterangan Hasil Ujian</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control @error('file-skhu') is-invalid @enderror" id="file-skhu" name="file-skhu" onchange="imagePreviewFunc(this, imagePreview_4)" type="file">
                                        @error('file-skhu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_4">
                                            @if ($CalSis?->detailSiswa?->filefc_skhu)
                                                <img alt="SKHU {{ $CalSis->nama }}" src="{{ route('siswa.berkas', $CalSis->detailSiswa?->filefc_skhu) }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-skm">Scan Standar Kompetensi Mandiri</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control @error('file-skm') is-invalid @enderror" id="file-skm" name="file-skm" onchange="imagePreviewFunc(this, imagePreview_5)" type="file">
                                        @error('file-skm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_5">
                                            @if ($CalSis?->detailSiswa?->filefc_skm)
                                                <img alt="SKM {{ $CalSis->nama }}" src="{{ route('siswa.berkas', $CalSis->detailSiswa?->filefc_skm) }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-20">Informasi Pendaftaran</h6>
                                    <div class="mb-20">
                                        <label class="form-label @error('info-pendaftaran') is-invalid @enderror">Sumber Informasi Pendaftaran</label>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('facebook', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="facebook" name="info-pendaftaran[]" type="checkbox" value="facebook">
                                            <label class="form-check-label" for="facebook">Facebook</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('tiktok', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="tiktok" name="info-pendaftaran[]" type="checkbox" value="tiktok">
                                            <label class="form-check-label" for="tiktok">Tiktok</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('instagram', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="instagram" name="info-pendaftaran[]" type="checkbox" value="instagram">
                                            <label class="form-check-label" for="instagram">Instagram</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('media_cetak', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="baner" name="info-pendaftaran[]" type="checkbox" value="media_cetak">
                                            <label class="form-check-label" for="baner">Baner/Brosur</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('youtube', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="youtube" name="info-pendaftaran[]" type="checkbox" value="youtube">
                                            <label class="form-check-label" for="youtube">Youtube</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('twitter', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="twitter" name="info-pendaftaran[]" type="checkbox" value="twitter">
                                            <label class="form-check-label" for="twitter">Twitter</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('masyarakat', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="masyarakat" name="info-pendaftaran[]" type="checkbox" value="masyarakat">
                                            <label class="form-check-label" for="masyarakat">Masyarakat</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(in_array('website', old('info-pendaftaran', $CalSis?->detailSiswa?->info_pendaftaran ?? []))) class="form-check-input" id="website" name="info-pendaftaran[]" type="checkbox" value="website">
                                            <label class="form-check-label" for="website">Website</label>
                                        </div>
                                        @error('info-pendaftaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-32">
                            <button class="btn btn-primary-600 radius-10 w-100 fw-semibold px-32" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function onChangeSelect(url, id, name, title) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append(`<option hidden>Pilih ${title}...</option>`);

                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $('#provinsi-siswa').on('change', function() {
                onChangeSelect('{{ route('regencies') }}', $(this).val(), 'kabupaten-siswa', 'Kabupaten');
            });
            $('#kabupaten-siswa').on('change', function() {
                onChangeSelect('{{ route('districts') }}', $(this).val(), 'kecamatan-siswa', 'Kecamatan');
            })
            $('#kecamatan-siswa').on('change', function() {
                onChangeSelect('{{ route('villages') }}', $(this).val(), 'desa-kelurahan-siswa', 'Desa/Kelurahan');
            })
        });
    </script>
    <script>
        function imagePreviewFunc(that, previewerId) {
            let files = that.files
            previewerId.innerHTML = '' // reset image preview element

            for (let i = 0; i < files.length; i++) {
                let imager = document.createElement("img");
                imager.src = URL.createObjectURL(files[i]);
                previewerId.append(imager);
            }
        }
    </script>
    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        };
    </script>
    <script>
        const rupiahInputs = document.querySelectorAll('.rupiah');

        rupiahInputs.forEach(function(input) {
            // Format saat pertama kali halaman dimuat
            if (input.value) {
                input.value = formatRupiah(input.value, 'Rp. ');
            }
            // Format saat user mengetik
            input.addEventListener('keyup', function(e) {
                this.value = formatRupiah(this.value, 'Rp. ');
            });
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {

            let number_string = angka.replace(/[^,\d]/g, '').replace(/^0+(?!$)/, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        document.querySelector('#ppdb-form').addEventListener('submit', function() {
            rupiahInputs.forEach(function(input) {
                // Hapus semua selain angka
                input.value = input.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endpush
