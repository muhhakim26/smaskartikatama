@extends('layouts.guest.preset')
@section('judul', 'Form Pendaftaran PPDB')
@section('konten')
    @include('layouts.guest.hero', ['judul' => 'Form Pendaftaran PPDB'])
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
            <form action="{{ route('ppdb.store', $Gelombang->id) }}" id="ppdb-create" method="post">
                @csrf
                <div class="py-32">
                    <div class="d-flex flex-column align-items-center mb-20 gap-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="nisn-siswa">NISN</label>
                            <input class="form-control" id="nisn-siswa" maxlength="10" name="nisn-siswa" onkeypress="return hanyaAngka(event)" placeholder="NISN" required type="text" value="{{ old('nisn-siswa') }}">
                            @error('nisn-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="nama-siswa">Nama</label>
                            <input class="form-control" id="nama-siswa" name="nama-siswa" placeholder="Nama" required type="text" value="{{ old('nama-siswa') }}">
                            @error('nama-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="email-siswa">Email</label>
                            <input class="form-control" id="email-siswa" name="email-siswa" placeholder="Email" required type="email" value="{{ old('email-siswa') }}">
                            @error('email-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="no-hp-siswa">Nomor HP</label>
                            <input class="form-control @error('no-hp-siswa') is-invalid @enderror" id="no-hp-siswa" name="no-hp-siswa" onkeypress="return hanyaAngka(event)" pattern="^[0-9\-\+\s\(\)]*$" placeholder="No HP" type="tel" value="{{ old('no-hp-siswa') }}">
                            @error('no-hp-siswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="kata-sandi">Sandi</label>
                            <div class="position-relative">
                                <input class="form-control" id="kata-sandi" name="kata-sandi" required type="password">
                                <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi"></span>
                            </div>
                            @error('kata-sandi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-primary-light mb-8 text-sm" for="kata-sandi_confirmation">Sandi Konfirmasi <span class="text-danger-600">*</span></label>
                            <div class="position-relative">
                                <input class="form-control radius-8" id="kata-sandi_confirmation" name="kata-sandi_confirmation" required type="password">
                                <span class="toggle-password ri-eye-line ri-eye-off-line position-absolute top-50 translate-middle-y text-secondary-light end-0 me-16 cursor-pointer" data-toggle="#kata-sandi_confirmation"></span>
                            </div>
                            @error('kata-sandi_confirmation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="py-3">
                                <button class="btn btn-primary-600 r w-100 fw-semibold" type="submit">Kirim Formulir Pendaftaran</button>
                            </div>
                        </div>
                    </div>
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
        function initializePasswordToggle(toggleSelector) {
            $(toggleSelector).on("click", function() {
                $(this).toggleClass("ri-eye-off-line");
                var input = $($(this).attr("data-toggle"));
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        }
        // Call the function
        initializePasswordToggle(".toggle-password");
    </script>
    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        };
    </script>
@endpush
