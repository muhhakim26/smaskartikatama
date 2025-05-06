@extends('layouts/user/preset')
@section('judul', 'Form Pendaftaran PPDB')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Form Pendaftaran PPDB'])
    <!-- PPDB Section -->
    <section class="py-80" id="berita">
        <div class="container">
            <h5 class="mb-40">Formulir Pendaftaran Calon Siswa Baru</h5>
            {{-- blade-formatter-disable --}}
            @if (session()->has('message'))
                <div @class([ 'p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'alert alert-danger' => session()->get('hasError'), ])>
                   <p>{{ session()->get('message') }}</p>
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
            <form action="{{ route('kelola-ppdb.store') }}" enctype="multipart/form-data" id="ppdb-create" method="post">
                @csrf
                <div class="py-32">
                    <h6 class="mb-20">Data Calon Siswa</h6>
                    <div class="row g-5 mb-20">
                        <div class="col-md-6">
                            <label class="form-label" for="nama-siswa">Nama</label>
                            <input class="form-control" id="nama-siswa" name="nama-siswa" placeholder="Nama" required type="text" value="{{ old('nama-siswa') }}">
                            @error('nama-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="provinsi-siswa">Provinsi</label>
                            <select class="form-select" id="provinsi-siswa" name="provinsi-siswa" required>
                                <option hidden>Pilih...</option>
                                @foreach ($Provinsi as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                <input @checked(old('jenis-kelamin-siswa') == 'laki-laki') class="form-check-input" id="laki-laki" name="jenis-kelamin-siswa" required type="radio" value="laki-laki">
                                <label class="form-check-label" for="laki-laki">Laki-laki</label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-10">
                                <input @checked(old('jenis-kelamin-siswa') == 'perempuan') class="form-check-input" id="perempuan" name="jenis-kelamin-siswa" required type="radio" value="perempuan">
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
                            </select>
                            @error('kabupaten-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-5 mb-20">
                        <div class="col-md-6">
                            <label class="form-label" for="nisn-siswa">NISN</label>
                            <input class="form-control" id="nisn-siswa" name="nisn-siswa" placeholder="NISN" maxlength="10" required type="number" value="{{ old('nisn-siswa') }}">
                            @error('nisn-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="kecamatan-siswa">Kecamatan</label>
                            <select class="form-select" id="kecamatan-siswa" name="kecamatan-siswa" required>
                                <option hidden>Pilih...</option>
                            </select>
                            @error('kecamatan-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-5 mb-20">
                        <div class="col-md-6">
                            <label class="form-label" for="tempat-lahir-siswa">Tempat Lahir</label>
                            <input class="form-control" id="tempat-lahir-siswa" name="tempat-lahir-siswa" placeholder="Tempat Lahir" required type="text" value="{{ old('tempat-lahir-siswa') }}">
                            @error('tempat-lahir-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="desa-kelurahan-siswa">Desa/Kelurahan</label>
                            <select class="form-select" id="desa-kelurahan-siswa" name="desa-kelurahan-siswa" required>
                                <option hidden>Pilih...</option>
                            </select>
                            @error('desa-kelurahan-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-5 mb-20">
                        <div class="col-md-6">
                            <label class="form-label" for="tanggal-lahir-siswa">Tanggal Lahir</label>
                            <input class="form-control" id="tanggal-lahir-siswa" name="tanggal-lahir-siswa" placeholder="Tanggal Lahir" required type="date" value="{{ old('tanggal-lahir-siswa') }}">
                            @error('tanggal-lahir-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="kode-pos-siswa">Kode POS</label>
                            <input class="form-control" id="kode-pos-siswa" name="kode-pos-siswa" placeholder="Kode POS" required type="text" value="{{ old('kode-pos-siswa') }}">
                            @error('kode-pos-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-5 mb-20">
                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <div class="form-check d-flex align-items-center mb-10">
                                <input class="form-check-input" id="buddha" name="agama-siswa" type="radio" value="buddha">
                                <label class="form-check-label" for="buddha">Buddha</label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-10">
                                <input class="form-check-input" id="hindu" name="agama-siswa" type="radio" value="hindu">
                                <label class="form-check-label" for="hindu">Hindu</label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-10">
                                <input class="form-check-input" id="khonghucu" name="agama-siswa" type="radio" value="khonghucu">
                                <label class="form-check-label" for="khonghucu">Khonghucu</label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-10">
                                <input class="form-check-input" id="katolik" name="agama-siswa" type="radio" value="kristen_katolik">
                                <label class="form-check-label" for="katolik">Katolik</label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-10">
                                <input class="form-check-input" id="protestan" name="agama-siswa" type="radio" value="kristen_protestan">
                                <label class="form-check-label" for="protestan">Protestan</label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-10">
                                <input class="form-check-input" id="islam" name="agama-siswa" required type="radio" value="islam">
                                <label class="form-check-label" for="islam">Islam</label>
                            </div>
                            @error('agama-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email-siswa">Email</label>
                            <input class="form-control" id="email-siswa" name="email-siswa" placeholder="Email" required type="email" value="{{ old('email-siswa') }}">
                            @error('email-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-5 mb-20">
                        <div class="col-md-6">
                            <label class="form-label" for="asal-sekolah-siswa">Asal Sekolah SMP/Mts</label>
                            <input class="form-control" id="asal-sekolah-siswa" name="asal-sekolah-siswa" placeholder="Asal Sekolah" required type="text" value="{{ old('asal-sekolah-siswa') }}">
                            @error('asal-sekolah-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="no-hp-siswa">Nomor HP</label>
                            <input class="form-control" id="no-hp-siswa" name="no-hp-siswa" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" required type="tel" value="{{ old('no-hp-siswa') }}">
                            @error('no-hp-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-5 mb-20">
                        <div class="col-md-6">
                            <label class="form-label" for="alamat-siswa">Alamat</label>
                            <textarea class="form-control" id="alamat-siswa" name="alamat-siswa" placeholder="Alamat" required rows="3">{{ old('alamat-siswa') }}</textarea>
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
                                <input class="form-control" id="nama-ayah-siswa" name="nama-ayah-siswa" placeholder="Nama" required type="text"value="{{ old('nama-ayah-siswa') }}">
                                @error('nama-ayah-siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="pendikian-terakhir-ayah">Pendidikan Terakhir</label>
                                <input class="form-control" id="pendikian-terakhir-ayah" name="pendikian-terakhir-ayah" placeholder="Pendidikan Terakhir" required type="text" value="{{ old('pendikian-terakhir-ayah') }}">
                                @error('pendikian-terakhir-ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="pekerjaan-ayah">Pekerjaan</label>
                                <input class="form-control" id="pekerjaan-ayah" name="pekerjaan-ayah" placeholder="Pekerjaan" required type="text" value="{{ old('pekerjaan-ayah') }}">
                                @error('pekerjaan-ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="penghasilan-ayah">Pengehasilan (Perbulan)</label>
                                <input class="form-control" id="penghasilan-ayah" name="penghasilan-ayah" placeholder="Penghasilan" required type="number" value="{{ old('penghasilan-ayah') }}">
                                @error('penghasilan-ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="no-hp-ayah">No HP</label>
                                <input class="form-control" id="no-hp-ayah" name="no-hp-ayah" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" required type="tel" value="{{ old('no-hp-ayah') }}">
                                @error('no-hp-ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-20">Data Ibu</h6>
                            <div class="mb-20">
                                <label class="form-label" for="nama-ibu-siswa">Nama Lengkap</label>
                                <input class="form-control" id="nama-ibu-siswa" name="nama-ibu-siswa" placeholder="Nama" required type="text" value="{{ old('nama-ibu-siswa') }}">
                                @error('nama-ibu-siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="pendikian-terakhir-ibu">Pendidikan Terakhir</label>
                                <input class="form-control" id="pendikian-terakhir-ibu" name="pendikian-terakhir-ibu" placeholder="Pendidikan Terakhir" required type="text" value="{{ old('pendikian-terakhir-ibu') }}">
                                @error('pendikian-terakhir-ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="pekerjaan-ibu">Pekerjaan</label>
                                <input class="form-control" id="pekerjaan-ibu" name="pekerjaan-ibu" placeholder="Pekerjaan" required type="text" value="{{ old('pekerjaan-ibu') }}">
                                @error('pekerjaan-ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="penghasilan-ibu">Pengehasilan (Perbulan)</label>
                                <input class="form-control" id="penghasilan-ibu" name="penghasilan-ibu" placeholder="Penghasilan" required type="number" value="{{ old('penghasilan-ibu') }}">
                                @error('penghasilan-ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="no-hp-ibu">No HP</label>
                                <input class="form-control" id="no-hp-ibu" name="no-hp-ibu" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" required type="tel" value="{{ old('no-hp-ibu') }}">
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
                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-ft-siswa" name="file-ft-siswa" required type="file">
                                @error('file-ft-siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="file-akte">Scan Akta Kelahiran</label>
                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-akte" name="file-akte" required type="file">
                                @error('file-akte')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="file-kk">Scan Kartu Keluarga</label>
                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-kk" name="file-kk" required type="file">
                                @error('file-kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="file-skhu">Scan Surat Keterangan Hasil Ujian</label>
                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-skhu" name="file-skhu" required type="file">
                                @error('file-skhu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-20">
                                <label class="form-label" for="file-skm">Scan Standar Kompetensi Mandiri</label>
                                <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="file-skm" name="file-skm" required type="file">
                                @error('file-skm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-20">Informasi Pendaftaran</h6>
                            <div class="mb-20">
                                <label class="form-label">Sumber Informasi Pendaftaran</label>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'facebook') class="form-check-input" id="facebook" name="info-pendaftaran" type="radio" value="facebook">
                                    <label class="form-check-label" for="facebook">Facebook</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'tiktok') class="form-check-input" id="tiktok" name="info-pendaftaran" type="radio" value="tiktok">
                                    <label class="form-check-label" for="tiktok">Tiktok</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'instagram') class="form-check-input" id="instagram" name="info-pendaftaran" type="radio" value="instagram">
                                    <label class="form-check-label" for="instagram">Instagram</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'media_cetak') class="form-check-input" id="baner" name="info-pendaftaran" type="radio" value="media_cetak">
                                    <label class="form-check-label" for="baner">Baner/Brosur</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'youtube') class="form-check-input" id="youtube" name="info-pendaftaran" type="radio" value="youtube">
                                    <label class="form-check-label" for="youtube">Youtube</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'twitter') class="form-check-input" id="twitter" name="info-pendaftaran" type="radio" value="twitter">
                                    <label class="form-check-label" for="twitter">Twitter</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'masyarakat')class="form-check-input" id="masyarakat" name="info-pendaftaran" type="radio" value="masyarakat">
                                    <label class="form-check-label" for="masyarakat">Masyarakat</label>
                                </div>
                                <div class="form-check d-flex align-items-center mb-10">
                                    <input @checked(old('info-pendaftaran') == 'website') class="form-check-input" id="website" name="info-pendaftaran" type="radio" value="website">
                                    <label class="form-check-label" for="website">Website</label>
                                </div>
                                @error('info-pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center m-auto">
                    <button class="btn btn-primary-600 rounded-pill radius-50 w-100 fw-semibold max-w-440-px px-20 py-20" type="submit">Kirim Formulir Pendaftaran</button>
                </div>
            </form>
        </div>
    </section>
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
@endpush
