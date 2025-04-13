@extends('layouts/preset')
@section('judul', 'Daftar PPDB Siswa')
@section('konten')
    <div>
        <a href="{{ route('kelola-ppdb.index') }}">Kembali</a>
    </div>
    {{-- blade-formatter-disable --}}
        @if (session()->has('message'))
            <div @class(['p-4', 'font-bold' => session()->get('isActive'), 'text-gray-500' => !session()->get('isActive'), 'bg-red' => session()->get('hasError'),])>
                {{ session()->get('message') }}
            </div>
        @endif
    {{-- blade-formatter-enable --}}
    <form action="{{ route('kelola-ppdb.store') }}" enctype="multipart/form-data" id="ppdb-create" method="post">
        @csrf
        <h3>Data Pribadi</h3>
        <div>
            <label for="nama-siswa">Nama</label>
            <input id="nama-siswa" name="nama-siswa" required type="text" value="{{ old('nama-siswa') }}">
        </div>
        @error('nama-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label>Jenis Kelamin</label>
            <input id="laki-laki" name="jenis-kelamin-siswa" required type="radio" value="laki-laki">
            <label for="laki-laki">Laki-laki</label>
            <input id="perempuan" name="jenis-kelamin-siswa" type="radio" value="perempuan">
            <label for="perempuan">Perempuan</label>
        </div>
        @error('jenis-kelamin-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="nisn-siswa">Nomor Induk Siswa Nasional (NISN)</label>
            <input id="nisn-siswa" name="nisn-siswa" required type="text" value="{{ old('nisn-siswa') }}">
        </div>
        @error('nisn-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="tempat-lahir-siswa">Tempat Lahir</label>
            <input id="tempat-lahir-siswa" name="tempat-lahir-siswa" required type="text" value="{{ old('tempat-lahir-siswa') }}">
        </div>
        @error('tempat-lahir-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="tanggal-lahir-siswa">Tanggal Lahir</label>
            <input id="tanggal-lahir-siswa" name="tanggal-lahir-siswa" required type="date" value="{{ old('tanggal-lahir-siswa') }}">
        </div>
        @error('tanggal-lahir-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label>Agama</label>
            <input id="buddha" name="agama-siswa" type="radio" value="buddha">
            <label for="buddha">Buddha</label>
            <input id="hindu" name="agama-siswa" type="radio" value="hindu">
            <label for="hindu">Hindu</label>
            <input id="islam" name="agama-siswa" required type="radio" value="islam">
            <label for="islam">Islam</label>
            <input id="katolik" name="agama-siswa" type="radio" value="katolik">
            <label for="katolik">Katolik</label>
            <input id="khonghucu" name="agama-siswa" type="radio" value="khonghucu">
            <label for="khonghucu">Khonghucu</label>
            <input id="kristen" name="agama-siswa" type="radio" value="kristen">
            <label for="kristen">Kristen</label>
        </div>
        @error('agama-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label>Berkebutuhan Khusus</label>
            <input id="berkebutuhan-khusus-siswa-ya" name="berkebutuhan-khusus-siswa" required type="radio" value="1">
            <label for="berkebutuhan-khusus-siswa-ya">Ya</label>
            <input id="berkebutuhan-khusus-siswa-tidak" name="berkebutuhan-khusus-siswa" type="radio" value="0">
            <label for="berkebutuhan-khusus-siswa-tidak">Tidak</label>
        </div>
        @error('berkebutuhan-khusus-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div>
            <label for="alamat-siswa">Alamat Jalan</label>
            <textarea id="alamat-siswa" name="alamat-siswa" required>{{ old('alamat-siswa') }}</textarea>
        </div>
        @error('alamat-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="provinsi-siswa">Provinsi</label>
            <select id="provinsi-siswa" name="provinsi-siswa" required>
                <option hidden>Pilih Provinsi...</option>
                @foreach ($Provinsi as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        @error('provinsi-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="kabupaten-siswa">Kabupaten</label>
            <select id="kabupaten-siswa" name="kabupaten-siswa" required>
                <option hidden>Pilih Kabupaten...</option>
            </select>
        </div>
        @error('kabupaten-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="kecamatan-siswa">Kecamatan</label>
            <select id="kecamatan-siswa" name="kecamatan-siswa" required>
                <option hidden>Pilih Kecamatan...</option>
            </select>
        </div>
        @error('kecamatan-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="desa-kelurahan-siswa">Desa/Kelurahan</label>
            <select id="desa-kelurahan-siswa" name="desa-kelurahan-siswa" required>
                <option hidden>Pilih Desa/Kelurahan...</option>
            </select>
        </div>
        @error('desa-kelurahan-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="kode-pos-siswa">Kode Pos</label>
            <input id="kode-pos-siswa" name="kode-pos-siswa" required type="text" value="{{ old('kode-pos-siswa') }}">
        </div>
        @error('kode-pos-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="no-hp-orang-tua-siswa">Nomor HP Orang Tua</label>
            <input id="no-hp-orang-tua-siswa" name="no-hp-orang-tua-siswa" pattern="^[0-9\-\+\s\(\)]*$" required type="tel" value="{{ old('no-hp-orang-tua-siswa') }}">
        </div>
        @error('no-hp-orang-tua-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="no-hp-siswa">Nomor HP</label>
            <input id="no-hp-siswa" name="no-hp-siswa" pattern="^[0-9\-\+\s\(\)]*$" required type="tel" value="{{ old('no-hp-siswa') }}">
        </div>
        @error('no-hp-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="email-siswa">Email</label>
            <input name="email-siswa" required type="email" value="{{ old('email-siswa') }}">
        </div>
        @error('email-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="asal-sekolah-siswa">Asal Sekolah SMP/Mts</label>
            <input id="asal-sekolah-siswa" name="asal-sekolah-siswa" required type="text" value="{{ old('asal-sekolah-siswa') }}">
        </div>
        @error('asal-sekolah-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>
        <h3>Data Ayah Kandung</h3>
        <div>
            <label for="nama-ayah-siswa">Nama</label>
            <input id="nama-ayah-siswa" name="nama-ayah-siswa" required type="text" value="{{ old('nama-ayah-siswa') }}">
        </div>
        @error('nama-ayah-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="pendikian-terakhir-ayah">Pendidikan Terakhir</label>
            <input id="pendikian-terakhir-ayah" name="pendikian-terakhir-ayah" required type="text" value="{{ old('pendikian-terakhir-ayah') }}">
        </div>
        @error('pendikian-terakhir-ayah')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="pekerjaan-ayah">Pekerjaan</label>
            <input id="pekerjaan-ayah" name="pekerjaan-ayah" required type="text" value="{{ old('pekerjaan-ayah') }}">
        </div>
        @error('pekerjaan-ayah')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="penghasilan-ayah">Penghasilan</label>
            <input id="penghasilan-ayah" name="penghasilan-ayah" required type="number" value="{{ old('penghasilan-ayah') }}">
        </div>
        @error('penghasilan-ayah')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div>
            <label>Berkebutuhan Khusus</label>
            <input id="berkebutuhan-khusus-ayah-ya" name="berkebutuhan-khusus-ayah" required type="radio" value="1">
            <label for="berkebutuhan-khusus-ayah-ya">Ya</label>
            <input id="berkebutuhan-khusus-ayah-tidak" name="berkebutuhan-khusus-ayah" type="radio" value="0">
            <label for="berkebutuhan-khusus-ayah-tidak">Tidak</label>
        </div>
        @error('berkebutuhan-khusus-ayah')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <h3>Data Ibu Kandung</h3>
        <div>
            <label for="nama-ibu-siswa">Nama</label>
            <input id="nama-ibu-siswa" name="nama-ibu-siswa" required type="text" value="{{ old('nama-ibu-siswa') }}">
        </div>
        @error('nama-ibu-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="pendikian-terakhir-ibu">Pendidikan Terakhir</label>
            <input id="pendikian-terakhir-ibu" name="pendikian-terakhir-ibu" required type="text" value="{{ old('pendikian-terakhir-ibu') }}">
        </div>
        @error('pendikian-terakhir-ibu')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="pekerjaan-ibu">Pekerjaan</label>
            <input id="pekerjaan-ibu" name="pekerjaan-ibu" required type="text" value="{{ old('pekerjaan-ibu') }}">
        </div>
        @error('pekerjaan-ibu')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="penghasilan-ibu">Penghasilan</label>
            <input id="penghasilan-ibu" name="penghasilan-ibu" required type="number" value="{{ old('penghasilan-ibu') }}">
        </div>
        @error('penghasilan-ibu')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label>Berkebutuhan Khusus</label>
            <input id="berkebutuhan-khusus-ibu-ya" name="berkebutuhan-khusus-ibu" required type="radio" value="1">
            <label for="berkebutuhan-khusus-ibu-ya">Ya</label>
            <input id="berkebutuhan-khusus-ibu-tidak" name="berkebutuhan-khusus-ibu" type="radio" value="0">
            <label for="berkebutuhan-khusus-ibu-tidak">Tidak</label>
        </div>
        @error('berkebutuhan-khusus-ibu')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>
        <h3>Data Wali</h3>
        <div>
            <label for="nama-wali-siswa">Nama</label>
            <input id="nama-wali-siswa" name="nama-wali-siswa" type="text" value="{{ old('nama-wali-siswa') }}">
        </div>
        @error('nama-wali-siswa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label>Jenis Kelamin</label>
            <input class="deselectable" id="laki-laki-wali" name="jenis-kelamin-wali" type="radio" value="laki-laki">
            <label for="laki-laki-wali">Laki-laki</label>
            <input class="deselectable" id="perempuan-wali name="jenis-kelamin-wali" type="radio" value="perempuan">
            <label for="perempuan-wali">Perempuan</label>
        </div>
        @error('jenis-kelamin-wali')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="pendikian-terakhir-wali">Pendidikan Terakhir</label>
            <input id="pendikian-terakhir-wali" name="pendikian-terakhir-wali" type="text" value="{{ old('pendikian-terakhir-wali') }}">
        </div>
        @error('pendikian-terakhir-wali')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="pekerjaan-wali">Pekerjaan</label>
            <input id="pekerjaan-wali" name="pekerjaan-wali" type="text" value="{{ old('pekerjaan-wali') }}">
        </div>
        @error('pekerjaan-wali')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="penghasilan-wali">Penghasilan</label>
            <input id="penghasilan-wali" name="penghasilan-wali" type="number" value="{{ old('penghasilan-wali') }}">
        </div>
        @error('penghasilan-wali')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label>Berkebutuhan Khusus</label>
            <input class="deselectable" id="berkebutuhan-khusus-wali-ya" name="berkebutuhan-khusus-wali" type="radio" value="1">
            <label for="berkebutuhan-khusus-wali-ya">Ya</label>
            <input class="deselectable" id="berkebutuhan-khusus-wali-tidak" name="berkebutuhan-khusus-wali" type="radio" value="0">
            <label for="berkebutuhan-khusus-wali-tidak">Tidak</label>
        </div>
        @error('berkebutuhan-khusus-wali')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <hr>
        <div>
            <label for="file-akte">Fotokopi Akte</label>
            <input accept="image/jpg, image/png, image/jpeg" id="file-akte" name="file-akte" required type="file">
        </div>
        @error('file-akte')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="file-kk">Fotokopi Kartu Keluarga</label>
            <input accept="image/jpg, image/png, image/jpeg" id="file-kk" name="file-kk" required type="file">
        </div>
        @error('file-kk')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="file-skhu">Fotokopi Surat Keterangan Hasil Ujian (SKHU)</label>
            <input accept="image/jpg, image/png, image/jpeg" id="file-skhu" name="file-skhu" required type="file">
        </div>
        @error('file-skhu')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <label for="file-skm">Fotokopi Surat Keterangan Miskin (SKM)</label>
            <input accept="image/jpg, image/png, image/jpeg" id="file-skm" name="file-skm" required type="file">
        </div>
        @error('file-skm')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div>
            <button type="submit">Buat</button>
        </div>
    </form>
@endsection
@push('script')
    <script>
        $('input[type="radio"].deselectable').on('click', function() {
            let $this = $(this);

            if ($this.data('wasChecked') == true) {
                $this.prop('checked', false);
                $this.data('wasChecked', false);
            } else {
                $('input[type="radio"]').data('wasChecked', false);
                $this.data('wasChecked', true);
            }
        });
    </script>
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
