@extends('layouts.guest.preset')
@section('judul', 'Halaman Utama')
@push('style')
    <style>
        .rounded-img {
            height: 397px;
            width: 330px;
            border-radius: 18px;
            object-fit: cover;
        }

        .bginfo-ppdb1 {
            background-image: url('{{ asset('assets/images/bgpendaftaran1.png') }}');
            background-size: cover;
            background-position: center;
            width: 100%;
        }

        .bginfo-ppdb2 {
            background-image: url('{{ asset('assets/images/bgpendaftaran2.png') }}');
            background-size: cover;
            background-position: center;
            width: 100%;
        }

        .card-gurutendik {
            background-color: #fff;
            border-radius: 16px;
            overflow: hidden;
        }
    </style>
@endpush
@section('konten')
    <!-- Hero Section -->
    <section id="hero">
        <div class="carousel slide max-h-612-px" data-bs-ride="carousel" id="hero-carousel">
            <div class="carousel-indicators">
                <button class="active" data-bs-slide-to="0" data-bs-target="#hero-carousel" type="button"></button>
                <button data-bs-slide-to="1" data-bs-target="#hero-carousel" type="button"></button>
                <button data-bs-slide-to="2" data-bs-target="#hero-carousel" type="button"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img alt="..." class="d-block max-h-612-px w-100 object-fit-cover" src="{{ asset('assets/images/bghero1.png') }}">
                    <div class="container">
                        <div class="carousel-caption pb-144 text-start">
                            <h3 class="mb-20 text-white">Menajdikan Generasi Cerdas, Berakhlak Mulia, Dan Berprestasi Gemilang</h3>
                            <p class="mb-36">SMAS Kartikatama Metro dengan menanamkan akhlak yang mulia menciptakan generasi para penerus untuk memimpin nusa dan bangsa yang cerdas dan gemilang.</p>
                            @if (!auth()->check())
                                <a class="btn btn-lg btn-primary radius-50 px-32 py-16" href="{{ route('info-ppdb') }}">Daftar Sebagai Siswa Baru</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img alt="..." class="d-block max-h-612-px w-100 object-fit-cover" src="{{ asset('assets/images/bghero2.png') }}">
                    <div class="container">
                        <div class="carousel-caption pb-144 text-start">
                            <h3 class="mb-20 text-white">Bersama SMAS Kartikatama Metro, Raih Prestasi dan Wujudkan Masa Depan!</h3>
                            <p class="mb-36">SMAS Kartikatama Metro hadir untuk mencetak generasi cerdas, kreatif, dan berkarakter unggul. Dengan lingkungan belajar yang inspiratif serta bimbingan berkualitas, kami mendorong setiap siswa untuk mencapai impian mereka dan menjadi pemimpin masa depan.</p>
                            <div class="d-flex gap-3 text-white">
                                @if (!auth()->check())
                                    <a class="btn rounded-pill btn-primary radius-50 px-32 py-16" href="{{ route('info-ppdb') }}">Daftar Sekarang</a>
                                    <a class="btn rounded-pill btn-outline-primary-600 radius-50 px-32 py-16" href="{{ route('info-ppdb') }}"><span class="text-base">Lihat Persyaratan</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img alt="..." class="d-block max-h-612-px w-100 object-fit-cover" src="{{ asset('assets/images/bghero3.png') }}">
                    <div class="container">
                        <div class="carousel-caption pb-144 text-start">
                            <h3 class="mb-20 text-white">Langkah Awal Menuju Kesuksesan Bersama SMAS Kartikatama Metro!</h3>
                            <p class="mb-36">SMAS Kartikatama Metro berkomitmen untuk mencetak generasi unggul dengan pendidikan berkualitas, karakter kuat, dan prestasi gemilang. Kami membuka peluang bagi setiap siswa untuk berkembang, berinovasi, dan siap menghadapi masa depan dengan percaya diri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sambutan Section -->
    <section class="py-90" id="sambutan">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-md-2">
                    {{-- {!! $SambutanKepsek->deskripsi !!} --}}
                    <h4 class="mb-16">Sambutan Kepala Sekolah</h4>
                    @if (!empty($SambutanKepsek->deskripsi))
                        {!! Str::words($SambutanKepsek->deskripsi, 130) !!}
                    @endif
                    <div class="py-3">
                        <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="{{ route('sambutan') }}">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-4 order-md-1">
                    <div class="d-flex justify-content-center">
                        @if (!empty($DataKepalaSekolah->file_foto))
                            <img alt="" class="rounded-img" src="{{ asset('img/' . $DataKepalaSekolah->file_foto) }}" style="height: 397px;width: 330px;">
                        @endif
                    </div>
                    <div class="py-24 text-center">
                        @if (!empty($DataKepalaSekolah->nama))
                            <h6>{{ $DataKepalaSekolah->nama }}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Program Section -->
    <section class="bg-body-secondary py-90 bg-opacity-50" id="program">
        <div class="container">
            <h4>Program-Program Unggulan SMAS Kartikatama Metro</h4>
            <div class="row g-4 mt-24">
                <div class="col-md-3">
                    <div class="card">
                        <img alt="..." class="card-img-top" src="{{ asset('assets/images/program-unggulan1.svg') }}">
                        <div class="card-body p-30">
                            <h5 class="card-title">Pendidikan Akhlak dan Karakter</h5>
                            <p class="card-text">Membentuk siswa dengan akhlak mulia dan karakter Islami yang kuat melalui pendekatan nilai-nilai moral.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img alt="..." class="card-img-top" src="{{ asset('assets/images/program-unggulan2.svg') }}">
                        <div class="card-body">
                            <h5 class="card-title">Ekstrakurikuler Kreatif dan Olahraga</h5>
                            <p class="card-text">Menyediakan berbagai kegiatan seni, olahraga, dan kreativitas untuk mengembangkan potensi siswa secara menyeluruh.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img alt="..." class="card-img-top" src="{{ asset('assets/images/program-unggulan3.svg') }}">
                        <div class="card-body">
                            <h5 class="card-title">Pondok Pendidikan Tahfiz Quran</h5>
                            <p class="card-text">Program unggulan untuk hafalan Al-Quran yang dibimbing oleh tenaga pengajar profesional dalam suasana Islami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img alt="..." class="card-img-top" src="{{ asset('assets/images/program-unggulan4.svg') }}">
                        <div class="card-body">
                            <h5 class="card-title">Study Bahasa Inggris di Pare, Kediri dan Flip Trip</h5>
                            <p class="card-text">Belajar intensif bahasa Inggris di Kampung Inggris, Pare, disertai perjalanan edukatif yang menambah wawasan siswa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Berita Section -->
    <section class="py-90" id="berita">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-32">
                <h4>Berita SMAS Kartikatama Metro</h4>
                <a class="btn btn-primary radius-50 px-24 py-12" href="{{ route('berita') }}">Lihat Semua</a>
            </div>
            <div class="row g-4">
                @if ($Berita->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <p class="24">
                        <h6 class="fw-bold text-secondary">Tidak Ada Berita Terbaru</h6>
                        </p>
                    </div>
                @else
                    @foreach ($Berita as $value)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body p-0">
                                    <a class="w-100 max-h-266-px radius-0 overflow-hidden" href="{{ route('berita', $value->id) }}">
                                        <img alt="{{ $value->judul }}" class="w-100 h-100 object-fit-cover" src="{{ asset('img/' . $value->file_foto) }}">
                                    </a>
                                    <div class="p-20">
                                        <h5 class="card-title mb-16"><a class="text-line-2 text-hover-primary-600 transition-2 text-xl" href="{{ route('infoberita', $value->id) }}">{{ $value->judul }}</a></h5>
                                        <p class="card-text text-line-3">{{ $value->kutipan }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-body-secondary">{{ $value->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Foto Section -->
    <section class="bg-body-secondary py-90 bg-opacity-50" id="foto">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-32">
                <h4>Galeri Foto SMAS Kartikatama Metro</h4>
                <a class="btn btn-primary radius-50 px-24 py-12" href="{{ route('foto') }}">Lihat Semua</a>
            </div>
            <div class="row gy-4">
                @if ($GaleriFoto->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <p class="24">
                        <h6 class="fw-bold text-secondary">Tidak Ada Foto Terbaru</h6>
                        </p>
                    </div>
                @else
                    @foreach ($GaleriFoto as $value)
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img radius-16 overflow-hidden border">
                                <div class="max-h-266-px overflow-hidden">
                                    <img alt="{{ $value->nama_foto }}" class="hover-scale-img__img w-100 h-100 object-fit-cover" src="{{ asset('img/' . $value->file_foto) }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Video Section -->
    <section class="py-110" id="video">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-32">
                <h4>Galeri Video SMAS Kartikatama Metro</h4>
                <a class="btn btn-primary radius-50 px-24 py-12" href="{{ route('video') }}">Lihat Semua</a>

            </div>
            <div class="row gy-4">
                @if ($GaleriVideo->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <p class="24">
                        <h6 class="fw-bold text-secondary">Tidak Ada Video Terbaru</h6>
                        </p>
                    </div>
                @else
                    @foreach ($GaleriVideo as $key => $value)
                        <div class="col-xxl-4 col-sm-6">
                            <div class="bg-base radius-8 overflow-hidden border">
                                <div class="position-relative max-h-258-px overflow-hidden">
                                    <a class="w-100" href="#">
                                        <img alt="thumbnail-{{ $key++ }}" class="w-100 object-fit-cover" src="{{ asset('img/' . $value->thumbnail) }}">
                                    </a>
                                    <a class="magnific-video bordered-shadow w-56-px h-56-px rounded-circle d-flex justify-content-center align-items-center position-absolute start-50 top-50 translate-middle z-1 bg-white" href="{{ $value->file_video }}">
                                        <iconify-icon class="text-primary-600 text-xxl" icon="ion:play"></iconify-icon>
                                    </a>
                                </div>
                                <a href="#">
                                    <div class="p-16">
                                        <h6 class="text-line-2 mb-6 text-xl">{{ $value->judul_video }}</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Staf Section -->
    <section class="bg-body-secondary py-110 bg-opacity-50" id="staf">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-32">
                <h4>Tenaga Kependidikan SMAS Kartikatama Metro</h4>
                <a class="btn btn-primary radius-50 px-24 py-12" href="{{ route('guru') }}">Lihat Semua</a>

            </div>
            <div class="row gy-4">
                @if ($DataGuru->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <p class="24">
                        <h6 class="fw-bold text-secondary">Tidak Ada Data Guru</h6>
                        </p>
                    </div>
                @else
                    @foreach ($DataGuru as $value)
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-body p-0">
                                    <a class="w-100 max-h-266-px radius-0 overflow-hidden" href="#">
                                        <img alt="{{ $value->nama }}" class="w-100 h-100 object-fit-cover" src="{{ asset('img/' . $value->file_foto) }}">
                                    </a>
                                    <div class="p-20 text-center">
                                        <h6 class="card-title mb-10"><a class="text-line-2 text-hover-primary-600 transition-2 text-xl" href="">{{ $value->nama }}</a></h6>
                                        <span class="text-secondary-light text-line-3">{{ $value->jabatan }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="py-144 bginfo-ppdb1" id="cta">
        <div class="container">
            <div class="max-w-1000-px m-auto text-center">
                <h3 class="text-uppercase fw-bold mb-28 text-white"> PENDAFTARAN PESERTA DIDIK BARU </h3>
                <p class="fw-normal mb-28 text-white">Selamat datang di SMAS Kartikatama Metro! Kami mengundang calon siswa untuk mendaftar dalam Penerimaan Peserta Didik Baru (PPDB). Dengan fasilitas lengkap, pengajaran berkualitas, dan berbagai kegiatan ekstrakurikuler, kami siap mendukung potensi Anda. Datang dan lihat mengapa kami menjadi pilihan tepat untuk masa depan pendidikan Anda. Jangan ragu untuk menghubungi kami atau kunjungi website kami untuk informasi lebih lanjut.</p>
                <div class="d-flex justify-content-center gap-3 text-white">
                    <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="{{ route('info-ppdb') }}">Daftar Sekarang</a>
                    <a class="btn rounded-pill btn-outline-primary-600 radius-50 px-28 py-12" href="{{ route('info-ppdb') }}"><span class="text-base">Lihat Persyaratan</span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Schedule Section -->
    <section class="py-120" id="schedule">
        <div class="container">
            <div class="mb-32">
                <h4>Jadwal PPDB SMAS Kartikatama Metro</h4>
            </div>
            <div class="row gy-4">
                {{-- Harus ada data di table gelombang pendaftaran --}}
                @foreach ($Gelombang as $key => $value)
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body p-6">
                                <div class="p-20">
                                    <h5 class="mb-36 text-center"><a class="text-uppercase text-line-2 text-primary-600 text-hover-primary-600 transition-2 disabled" href="#"><strong>Batch {{ $value->id }}</strong></a></h5>
                                    <div class="mb-32 text-black">
                                        @if ($value->status_pendaftaran === 1)
                                            <p class="mb-10">Pendaftaran Batch {{ $value->id }}</p>
                                            <p class="mb-10">{{ $value->tanggal_dibuka }} s.d. {{ $value->tanggal_ditutup }}</p>
                                            {!! $value->catatan !!}
                                            <p class="fst-italic mb-10">* Kuota Pendaftar {{ $value->kuota_pendaftaran }} Orang Siswa/i</p>
                                        @else
                                            <p class="mb-10">Pendaftaran Batch {{ $value->id }} Ditutup</p>
                                            <p class="mb-10">- s.d. -</p>
                                            <p class="mb-10">Lokasi: -</p>
                                            <p class="mb-10">-</p>
                                            <p class="fst-italic mb-10">* Kuota Pendaftar - Orang Siswa/i</p>
                                        @endif
                                    </div>
                                    {{-- blade-formatter-disable --}}
                                    <a @class([ 'btn rounded-pill btn-primary radius-50 w-100 py-12', 'disabled' => !$value->status_pendaftaran ||  auth()->check() ]) href="{{ $value->status_pendaftaran ? route('ppdb.index', $value->id) : '#' }}">Daftar Batch {{$value->id}}</a>
                                    {{-- blade-formatter-enable --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Info Section -->
    <section class="py-120 mb-140 bginfo-ppdb2" id="info">
        <div class="container">
            <div class="max-w-1000-px m-auto">
                <h5 class="text-uppercase fw-bold mb-28 text-white">Layanan Informasi PPDB SMAS Kartikatama Metro</h5>
                <p class="fw-normal mb-28 text-white">
                    Kami menyediakan informasi lengkap dan terkini mengenai Penerimaan Peserta Didik Baru (PPDB) SMAS Kartikatama Metro.
                    Layanan ini dirancang untuk membantu calon siswa dan orang tua memahami alur pendaftaran, persyaratan, jadwal, serta program pendidikan yang ditawarkan oleh sekolah.
                    Dengan pendekatan yang profesional dan responsif, kami berkomitmen untuk memastikan proses pendaftaran berjalan dengan lancar, transparan, dan mudah diakses.
                </p>
                <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="https://api.whatsapp.com/send?phone=6285888082608&text=Assalamualaikum%2C%20%0ASaya%20telah%20melihat%20informasi%20PPDB%20SMAS%20Kartikatama%20Metro%20dan%20ingin%20menanyakan%20beberapa%20hal%20lebih%20lanjut.">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection

@push('script')
    @if (session()->has('message'))
        <script>
            Swal2.fire({
                icon: "success",
                timer: 1500,
                title: "{{ session()->get('message') }}",
                showConfirmButton: false,
            });
        </script>
    @endif
    <script>
        $(".magnific-video").magnificPopup({
            type: "iframe"
        });
    </script>
@endpush
