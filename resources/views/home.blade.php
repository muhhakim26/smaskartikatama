@extends('layouts.user.preset')
@section('judul', 'Halaman Utama')
@push('style')
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
                    <img alt="..." class="d-block max-h-612-px w-100 object-fit-cover" src="{{ asset('assets/images/gambar-sekolah.svg') }}">
                    <div class="container">
                        <div class="carousel-caption pb-144 text-start">
                            <h3 class="mb-20 text-white">Menajdikan Generasi Cerdas, Berakhlak Mulia, Dan Berprestasi Gemilang</h3>
                            <p class="mb-36">SMAS Kartikatama Metro dengan menanamkan akhlak yang mulia menciptakan generasi para penerus untuk memimpin nusa dan bangsa yang cerdas dan gemilang.</p>
                            <a class="btn btn-lg btn-primary radius-50 px-30 py-15" href="#">Daftar Sebagai Siswa Baru</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img alt="..." class="d-block max-h-612-px w-100 object-fit-cover" src="https://abh.ai/landscapes/1000/1000">
                </div>
                <div class="carousel-item">
                    <img alt="..." class="d-block max-h-612-px w-100 object-fit-cover" src="https://abh.ai/landscapes/1000/1000">
                </div>
            </div>
        </div>
    </section>
    <!-- Sambutan Section -->
    <section class="py-120" id="sambutan">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-md-2">
                    <!-- <h4 class="fw-normal lh-2">Sambutan Kepala Sekolah<span class="text-body-secondary"></span></h4> -->
                    {{-- {!! $SambutanKepsek->deskripsi !!} --}}
                    {!! Str::words($SambutanKepsek->deskripsi, 200) !!}
                    <div class="py-3">
                        <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="#">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-4 order-md-1">
                    <div class="d-flex justify-content-center">
                        <img alt="" class="object-fit-cover" style="height: 397px;width: 330px;" src="{{ asset('img/' . $DataKepalaSekolah->file_foto) }}">
                    </div>
                    <div class="text-center py-32">
                        <h5>{{ $DataKepalaSekolah->nama }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Program Section -->
    <section class="bg-body-secondary py-120 bg-opacity-50" id="program">
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
                            <h5 class="card-title">Ekstrakulikuler Kreatif dan Olahraga</h5>
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
    <section class="py-120" id="berita">
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
    <section class="bg-body-secondary py-120 bg-opacity-50" id="foto">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-32">
                <h4>Galeri Foto SMAS Kartikatama Metro</h4>
                <a class="btn btn-primary radius-50 px-24 py-12 href=" {{ route('foto') }}">Lihat Semua</a>

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
    <section class="py-120" id="video">
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
    <section class="bg-body-secondary py-120 bg-opacity-50" id="staf">
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
    <section class="bg-dark bg-gradient py-120 bg-opacity-75" id="cta">
        <div class="container">
            <div class="max-w-1000-px m-auto text-center">
                <h3 class="text-uppercase fw-bold mb-28 text-white"> PENDAFTARAN PESERTA DIDIK BARU </h3>
                <p class="fw-normal mb-28 text-white">Selamat datang di SMAS Kartikatama Metro! Kami mengundang calon siswa untuk mendaftar dalam Penerimaan Peserta Didik Baru (PPDB). Dengan fasilitas lengkap, pengajaran berkualitas, dan berbagai kegiatan ekstrakurikuler, kami siap mendukung potensi Anda. Datang dan lihat mengapa kami menjadi pilihan tepat untuk masa depan pendidikan Anda. Jangan ragu untuk menghubungi kami atau kunjungi website kami untuk informasi lebih lanjut.</p>
                <div class="d-flex justify-content-center gap-3 text-white">
                    <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="#">Daftar Sekarang</a>
                    <a class="btn rounded-pill btn-outline-primary-600 radius-50 px-28 py-12" href="#"><span class="text-base">Lihat Persyaratan</span></a>
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
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-6">
                            <div class="p-20">
                                <h5 class="mb-36 text-center"><a class="text-uppercase text-line-2 text-primary-600 text-hover-primary-600 transition-2" href="">Batch 1</a></h5>
                                <div class="mb-32 text-black">
                                    <p class="mb-10">Pendaftaran Batch 1</p>
                                    <p class="mb-10">21 Agustus s.d. 30 Desember 2024</p>
                                    <p class="mb-10">Lokasi: SMAS Kartikatama Metro</p>
                                    <p class="mb-10">Offline: 10.00 WIB sampai 15.00 WIB</p>
                                    <p class="mb-10">Online 24 Jam</p>
                                    <p class="fst-italic mb-10">* Kuota Pendaftar 150 Orang Siswa</p>
                                </div>
                                <a class="btn rounded-pill btn-primary radius-50 w-100 py-12" href="#">Daftar Batch 1</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-6">
                            <div class="p-20">
                                <h5 class="mb-36 text-center"><a class="text-uppercase text-line-2 text-primary-600 text-hover-primary-600 transition-2" href="">Batch 1</a></h5>
                                <div class="mb-32 text-black">
                                    <p class="mb-10">Pendaftaran Batch 1</p>
                                    <p class="mb-10">21 Agustus s.d. 30 Desember 2024</p>
                                    <p class="mb-10">Lokasi: SMAS Kartikatama Metro</p>
                                    <p class="mb-10">Offline: 10.00 WIB sampai 15.00 WIB</p>
                                    <p class="mb-10">Online 24 Jam</p>
                                    <p class="fst-italic mb-10">* Kuota Pendaftar 150 Orang Siswa</p>
                                </div>
                                <a class="btn rounded-pill btn-primary radius-50 w-100 py-12" href="#">Daftar Batch 1</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body p-6">
                            <div class="p-20">
                                <h5 class="mb-36 text-center"><a class="text-uppercase text-line-2 text-primary-600 text-hover-primary-600 transition-2" href="">Batch 1</a></h5>
                                <div class="mb-32 text-black">
                                    <p class="mb-10">Pendaftaran Batch 1</p>
                                    <p class="mb-10">21 Agustus s.d. 30 Desember 2024</p>
                                    <p class="mb-10">Lokasi: SMAS Kartikatama Metro</p>
                                    <p class="mb-10">Offline: 10.00 WIB sampai 15.00 WIB</p>
                                    <p class="mb-10">Online 24 Jam</p>
                                    <p class="fst-italic mb-10">* Kuota Pendaftar 150 Orang Siswa</p>
                                </div>
                                <a class="btn rounded-pill btn-primary radius-50 w-100 py-12" href="#">Daftar Batch 1</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Info Section -->
    <section class="py-120 mb-120 bg-black" id="info">
        <div class="container">
            <div class="max-w-1000-px m-auto">
                <h5 class="text-uppercase fw-bold mb-28 text-white">Layanan Informasi PPDB SMAS Kartikatama Metro</h5>
                <p class="fw-normal mb-28 text-white">Kami menyediakan informasi lengkap dan terkini mengenai Penerimaan Peserta Didik Baru (PPDB) SMAS Kartikatama Metro. Layanan ini dirancang untuk membantu calon siswa dan orang tua memahami alur pendaftaran, persyaratan, jadwal, serta program pendidikan yang ditawarkan oleh sekolah. Dengan pendekatan yang profesional dan responsif, kami berkomitmen untuk memastikan proses pendaftaran berjalan dengan lancar, transparan, dan mudah diakses.</p>
                <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="#">Hubungi Kami</a>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(".magnific-video").magnificPopup({
            type: "iframe"
        });
    </script>
@endpush
