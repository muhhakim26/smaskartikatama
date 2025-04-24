@extends('layouts/preset')
@section('judul', 'Edit PPDB Siswa')

@section('konten')
    <!-- PPDB Section -->
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0">Edit Form</h6>
                </div>
                <div class="card-body">
                    {{-- blade-formatter-disable --}}
                        @if (session()->has('message'))
                            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    {{-- blade-formatter-enable --}}
                    <form action="{{ route('kelola-ppdb.update', $PPDB->id) }}" enctype="multipart/form-data" id="ppdb-create" method="post">
                        @csrf
                        @method('put')
                        <div class="py-32">
                            <h6 class="mb-20">Data Calon Siswa</h6>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="nama-siswa">Nama</label>
                                    <input class="form-control" id="nama-siswa" name="nama-siswa" placeholder="Nama" required type="text" value="{{ old('nama-siswa', $PPDB->nama) }}">
                                    @error('nama-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="provinsi-siswa">Provinsi</label>
                                    <select class="form-select" id="provinsi-siswa" name="provinsi-siswa" required>
                                        <option hidden>Pilih...</option>
                                        @foreach ($Provinsi as $value)
                                            <option @selected(old('provinsi-siswa', $PPDB->provinsi_id) == $value->id) value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('jenis-kelamin-siswa', $PPDB->jenis_kelamin == 'laki-laki')) class="form-check-input" id="laki-laki" name="jenis-kelamin-siswa" required type="radio" value="laki-laki">
                                        <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('jenis-kelamin-siswa', $PPDB->jenis_kelamin == 'perempuan')) class="form-check-input" id="perempuan" name="jenis-kelamin-siswa" required type="radio" value="perempuan">
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>
                                    @error('jenis-kelamin-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="kabupaten-siswa">Kabupaten</label>
                                    <select class="form-select" id="kabupaten-siswa" name="kabupaten-siswa" required>
                                        <option hidden>Pilih...</option>
                                        @foreach ($Kabupaten as $key => $value)
                                            <option @selected(old('kabupaten-siswa', $PPDB->kabupaten_id) == $key) value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('kabupaten-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="nisn-siswa">NISN</label>
                                    <input class="form-control" id="nisn-siswa" name="nisn-siswa" placeholder="NISN" required type="text" value="{{ old('nisn-siswa', $PPDB->nisn) }}">
                                    @error('nisn-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="kecamatan-siswa">Kecamatan</label>
                                    <select class="form-select" id="kecamatan-siswa" name="kecamatan-siswa" required>
                                        <option hidden>Pilih...</option>
                                        @foreach ($Kecamatan as $key => $value)
                                            <option @selected(old('kecamatan-siswa', $PPDB->kecamatan_id) == $key) value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="tempat-lahir-siswa">Tempat Lahir</label>
                                    <input class="form-control" id="tempat-lahir-siswa" name="tempat-lahir-siswa" placeholder="Tempat Lahir" required type="text" value="{{ old('tempat-lahir-siswa', $PPDB->tempat_lahir) }}">
                                    @error('tempat-lahir-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="desa-kelurahan-siswa">Desa/Kelurahan</label>
                                    <select class="form-select" id="desa-kelurahan-siswa" name="desa-kelurahan-siswa" required>
                                        <option hidden>Pilih...</option>
                                        @foreach ($Kelurahan as $key => $value)
                                            <option @selected(old('kelurahan-siswa', $PPDB->desa_kelurahan_id) == $key) value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('desa-kelurahan-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="tanggal-lahir-siswa">Tanggal Lahir</label>
                                    <input class="form-control" id="tanggal-lahir-siswa" name="tanggal-lahir-siswa" placeholder="Tanggal Lahir" required type="date" value="{{ old('tanggal-lahir-siswa', $PPDB->tgl_lahir) }}"">
                                    @error('tanggal-lahir-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="kode-pos-siswa">Kode POS</label>
                                    <input class="form-control" id="kode-pos-siswa" name="kode-pos-siswa" placeholder="Kode POS" required type="text" value="{{ old('kode-pos-siswa', $PPDB->kode_pos) }}">
                                    @error('kode-pos-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label">Agama</label>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $PPDB->agama == 'buddha')) class="form-check-input" id="buddha" name="agama-siswa" type="radio" value="buddha">
                                        <label class="form-check-label" for="buddha">Buddha</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $PPDB->agama == 'hindu')) class="form-check-input" id="hindu" name="agama-siswa" type="radio" value="hindu">
                                        <label class="form-check-label" for="hindu">Hindu</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $PPDB->agama == 'khonghucu')) class="form-check-input" id="khonghucu" name="agama-siswa" type="radio" value="khonghucu">
                                        <label class="form-check-label" for="khonghucu">Khonghucu</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $PPDB->agama == 'kristen_katolik')) class="form-check-input" id="katolik" name="agama-siswa" type="radio" value="kristen_katolik">
                                        <label class="form-check-label" for="katolik">Katolik</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $PPDB->agama == 'kristen_protestan')) class="form-check-input" id="protestan" name="agama-siswa" type="radio" value="kristen_protestan">
                                        <label class="form-check-label" for="protestan">Protestan</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-10">
                                        <input @checked(old('agama-siswa', $PPDB->agama == 'islam')) class="form-check-input" id="islam" name="agama-siswa" required type="radio" value="islam">
                                        <label class="form-check-label" for="islam">Islam</label>
                                    </div>
                                    @error('agama-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="email-siswa">Email</label>
                                    <input class="form-control" id="email-siswa" name="email-siswa" placeholder="Email" required type="email" value="{{ old('email-siswa', $PPDB->email) }}">
                                    @error('email-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="asal-sekolah-siswa">Asal Sekolah SMP/Mts</label>
                                    <input class="form-control" id="asal-sekolah-siswa" name="asal-sekolah-siswa" placeholder="Asal Sekolah" required type="text" value="{{ old('asal-sekolah-siswa', $PPDB->asal_sekolah) }}">
                                    @error('asal-sekolah-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="no-hp-siswa">Nomor HP</label>
                                    <input class="form-control" id="no-hp-siswa" name="no-hp-siswa" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" required type="tel" value="{{ old('no-hp-siswa', $PPDB->nhp_siswa) }}">
                                    @error('no-hp-siswa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-5 mb-20">
                                <div class="col-md-6">
                                    <label class="form-label" for="alamat-siswa">Alamat</label>
                                    <textarea class="form-control" id="alamat-siswa" name="alamat-siswa" placeholder="Alamat" required rows="3">{{ old('alamat-siswa', $PPDB->alamat) }}</textarea>
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
                                        <input class="form-control" id="nama-ayah-siswa" name="nama-ayah-siswa" placeholder="Nama" required type="text"value="{{ old('nama-ayah-siswa', $PPDB->nama_ayah) }}">
                                        @error('nama-ayah-siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pendikian-terakhir-ayah">Pendidikan Terakhir</label>
                                        <input class="form-control" id="pendikian-terakhir-ayah" name="pendikian-terakhir-ayah" placeholder="Pendidikan Terakhir" required type="text" value="{{ old('pendikian-terakhir-ayah', $PPDB->pend_terakhir_ayah) }}">
                                        @error('pendikian-terakhir-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pekerjaan-ayah">Pekerjaan</label>
                                        <input class="form-control" id="pekerjaan-ayah" name="pekerjaan-ayah" placeholder="Pekerjaan" required type="text" value="{{ old('pekerjaan-ayah', $PPDB->pekerjaan_ayah) }}">
                                        @error('pekerjaan-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="penghasilan-ayah">Pengehasilan (Perbulan)</label>
                                        <input class="form-control" id="penghasilan-ayah" name="penghasilan-ayah" placeholder="Penghasilan" required type="number" value="{{ old('penghasilan-ayah', $PPDB->penghasilan_ayah) }}">
                                        @error('penghasilan-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="no-hp-ayah">No HP</label>
                                        <input class="form-control" id="no-hp-ayah" name="no-hp-ayah" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" required type="tel" value="{{ old('no-hp-ayah', $PPDB->nhp_ayah) }}">
                                        @error('no-hp-ayah')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-20">Data Ibu</h6>
                                    <div class="mb-20">
                                        <label class="form-label" for="nama-ibu-siswa">Nama Lengkap</label>
                                        <input class="form-control" id="nama-ibu-siswa" name="nama-ibu-siswa" placeholder="Nama" required type="text" value="{{ old('nama-ibu-siswa', $PPDB->nama_ibu) }}">
                                        @error('nama-ibu-siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pendikian-terakhir-ibu">Pendidikan Terakhir</label>
                                        <input class="form-control" id="pendikian-terakhir-ibu" name="pendikian-terakhir-ibu" placeholder="Pendidikan Terakhir" required type="text" value="{{ old('pendikian-terakhir-ibu', $PPDB->pend_terakhir_ibu) }}">
                                        @error('pendikian-terakhir-ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="pekerjaan-ibu">Pekerjaan</label>
                                        <input class="form-control" id="pekerjaan-ibu" name="pekerjaan-ibu" placeholder="Pekerjaan" required type="text" value="{{ old('pekerjaan-ibu', $PPDB->pekerjaan_ibu) }}">
                                        @error('pekerjaan-ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="penghasilan-ibu">Pengehasilan (Perbulan)</label>
                                        <input class="form-control" id="penghasilan-ibu" name="penghasilan-ibu" placeholder="Penghasilan" required type="number" value="{{ old('penghasilan-ibu', $PPDB->penghasilan_ibu) }}">
                                        @error('penghasilan-ibu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="no-hp-ibu">No HP</label>
                                        <input class="form-control" id="no-hp-ibu" name="no-hp-ibu" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" required type="tel" value="{{ old('no-hp-ibu', $PPDB->nhp_ibu) }}">
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
                                    <div class="mb-20">
                                        <label class="form-label" for="file-ft-siswa">Foto 3x4</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-ft-siswa" name="file-ft-siswa" onchange="imagePreviewFunc(this, imagePreview_1)" type="file">
                                        @error('file-ft-siswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_1">
                                            <img alt="Foto Siswa {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->fileft_siswa) }}">
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-akte">Scan Akta Kelahiran</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-akte" name="file-akte" onchange="imagePreviewFunc(this, imagePreview_2)" type="file">
                                        @error('file-akte')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_2">
                                            <img alt="Akte {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_akte) }}">
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-kk">Scan Kartu Keluarga</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-kk" name="file-kk" onchange="imagePreviewFunc(this, imagePreview_3)" type="file">
                                        @error('file-kk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_3">
                                            <img alt="KK {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_kk) }}">
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-skhu">Scan Surat Keterangan Hasil Ujian</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-skhu" name="file-skhu" onchange="imagePreviewFunc(this, imagePreview_4)" type="file">
                                        @error('file-skhu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_4">
                                            <img alt="SKHU {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_skhu) }}">
                                        </div>
                                    </div>
                                    <div class="mb-20">
                                        <label class="form-label" for="file-skm">Scan Standar Kompetensi Mandiri</label>
                                        <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-skm" name="file-skm" onchange="imagePreviewFunc(this, imagePreview_5)" type="file">
                                        @error('file-skm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="imagePreview_5">
                                            <img alt="SKM {{ $PPDB->nama }}" src="{{ route('berkas', $PPDB->filefc_skm) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-20">Informasi Pendaftaran</h6>
                                    <div class="mb-20">
                                        <label class="form-label">Sumber Informasi Pendaftaran</label>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'facebook')) class="form-check-input" id="facebook" name="info-pendaftaran" type="radio" value="facebook">
                                            <label class="form-check-label" for="facebook">Facebook</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'tiktok')) class="form-check-input" id="tiktok" name="info-pendaftaran" type="radio" value="tiktok">
                                            <label class="form-check-label" for="tiktok">Tiktok</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'instagram')) class="form-check-input" id="instagram" name="info-pendaftaran" type="radio" value="instagram">
                                            <label class="form-check-label" for="instagram">Instagram</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'media_cetak')) class="form-check-input" id="baner" name="info-pendaftaran" type="radio" value="media_cetak">
                                            <label class="form-check-label" for="baner">Baner/Brosur</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'youtube')) class="form-check-input" id="youtube" name="info-pendaftaran" type="radio" value="youtube">
                                            <label class="form-check-label" for="youtube">Youtube</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'twttier')) class="form-check-input" id="twitter" name="info-pendaftaran" type="radio" value="twitter">
                                            <label class="form-check-label" for="twitter">Twitter</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'masyarakat')) class="form-check-input" id="masyarakat" name="info-pendaftaran" type="radio" value="masyarakat">
                                            <label class="form-check-label" for="masyarakat">Masyarakat</label>
                                        </div>
                                        <div class="form-check d-flex align-items-center mb-10">
                                            <input @checked(old('info-pendaftaran', $PPDB->info_pendaftaran == 'website')) class="form-check-input" id="website" name="info-pendaftaran" type="radio" value="website">
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
                            <button class="btn btn-primary-600 radius-10 w-50 fw-semibold max-w-440-px px-32" type="submit">Simpan</button>
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
        let formChanged = false;
        $('#ppdb-create').on('change', () => formChanged = true);
        $('#ppdb-create').on('submit', () => {
            formChanged = false;
            $(window).off('beforeunload');
        });
        $(window).on("beforeunload", (event) => {
            console.log(event);
            if (formChanged) {
                event.result = 'You have unfinished changes!';
            }
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
@endpush
