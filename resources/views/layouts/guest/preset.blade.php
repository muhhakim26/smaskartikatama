<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>SMASKARTIKATAMA | @yield('judul')</title>
    <!-- remix icon font css  -->
    <link href="{{ asset('assets/css/remixicon.css') }}" rel="stylesheet">
    <!-- BootStrap css -->
    <link href="{{ asset('assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Popup css -->
    <link href="{{ asset('assets/css/lib/magnific-popup.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/css/lib/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- main css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet"> --}}
    @stack('style')
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <img alt="Logo SMAS Kartikatama Metro" class="w-50-px h-50-px me-10" src="{{ asset('assets/images/logosmaskartikatamametro.png') }}">
                    <span class="fw-medium mb-0">SMAS Kartikatama Metro</span>
                </a>
                <button class="navbar-toggler" data-bs-target="#navigasi" data-bs-toggle="collapse" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navigasi">
                    <ul class="navbar-nav fw-medium align-items-center ms-auto">
                        <li class="nav-item mx-8">
                            <a @class(['nav-link', 'active' => Route::is('home')]) aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown mx-8">

                            {{-- blade-formatter-disable --}}
                            <a @class([ 'nav-link', 'dropdown-toggle', 'active' => Route::is('sambuatan') || Route::is('sejarah') || Route::is('visi-misi') || Route::is('struktur-organisasi') || Route::is('guru'), ]) aria-expanded="false" data-bs-toggle="dropdown" href="#" role="button"> Profil </a>
                           {{-- blade-formatter-enable --}}
                            {{-- blade-formatter-disable --}}
                            <ul class="dropdown-menu">
                                <li><a @class(['dropdown-item', 'active' => Route::is('sambuatan')]) href="{{ route('sambutan') }}">Sambuatan</a></li>
                                <li><a @class(['dropdown-item', 'active' => Route::is('sejarah')]) href="{{ route('sejarah') }}">Sejarah</a></li>
                                <li><a @class(['dropdown-item', 'active' => Route::is('visi-misi')]) href="{{ route('visi-misi') }}">Visi Misi</a></li>
                                <li><a @class([
                                    'dropdown-item',
                                    'active' => Route::is('struktur-organisasi'),
                                ]) href="{{ route('struktur-organisasi') }}">Struktur</a></li>
                                <li><a @class(['dropdown-item', 'active' => Route::is('guru')]) href="{{ route('guru') }}">Guru dan Staf</a></li>
                            </ul>
                            {{-- blade-formatter-enable --}}
                        </li>
                        <li class="nav-item dropdown mx-8">

                            {{-- blade-formatter-disable --}}
                            <a @class([ 'nav-link', 'dropdown-toggle', 'active' => Route::is('osis') || Route::is('ekstrakurikuler'), ]) aria-expanded="false" data-bs-toggle="dropdown" href="#" role="button"> Kesiswaan </a>
                            {{-- blade-formatter-enable --}}
                            <ul class="dropdown-menu">
                                <li><a @class(['dropdown-item', 'active' => Route::is('osis')]) href="{{ route('osis') }}">OSIS</a></li>
                                <li><a @class(['dropdown-item', 'active' => Route::is('ekstrakurikuler')]) href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown mx-8">
                            {{-- blade-formatter-disable --}}
                            <a @class([
                                'nav-link',
                                'dropdown-toggle',
                                'active' => Route::is('foto') || Route::is('video'),
                            ]) aria-expanded="false" data-bs-toggle="dropdown" href="#" role="button">Galeri</a>
                            {{-- blade-formatter-enabled --}}
                            <ul class="dropdown-menu">
                                <li><a @class(['dropdown-item', 'active' => Route::is('foto')]) href="{{ route('foto') }}">Foto</a></li>
                                <li><a @class(['dropdown-item', 'active' => Route::is('video')]) href="{{ route('video') }}">Video</a></li>
                            </ul>

                        </li>
                        <li class="nav-item mx-8">
                            <a @class(['nav-link', 'active' => Route::is('berita')]) href="{{ route('berita') }}">Berita</a>
                        </li>
                        <li class="nav-item mx-8">
                            <a @class(['nav-link', 'active' => Route::is('kontak')]) href="{{ route('kontak') }}">Kontak</a>
                        </li>
                        @if (!auth()->check())
                            <li class="nav-item m-auto">
                                <a class="btn btn-primary radius-50 px-20 py-12" href="{{ route('info-ppdb') }}">
                                    Pendaftaran PPDB
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @yield('konten')
    </main>
    <!-- Footer -->
    <footer class="border-top bg-white pb-28 pt-60">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="mb-32">
                        <span class="d-flex align-items-center">
                            <img alt="Logo SMAS Kartikatama Metro" class="w-50-px h-50-px me-10" src="{{ asset('assets/images/logosmaskartikatamametro.png') }}">
                            <span class="fw-medium mb-0">SMAS Kartikatama Metro</span>
                        </span>
                    </div>
                    <p>Jl. Kapten P. Tendean, Kecamatan Metro Selatan, Kota Metro, Lampung.</p>
                    <div class="d-flex gap-3">
                        <a class="link-body-emphasis" href="https://www.instagram.com/smaskartikatamametro?igsh=NTc4MTIwNjQ2YQ=="><iconify-icon height="24" icon="mdi:instagram" width="24"></iconify-icon></a>
                        <a class="link-body-emphasis" href="https://www.facebook.com/share/15xTbdfAKS/"><iconify-icon heightx="24" icon="ic:baseline-facebook" width="24"></iconify-icon></a>
                        <a class="link-body-emphasis" href="https://www.tiktok.com/@smaskartika?_t=ZS-8vk7wB7ttaR&_r=1"><iconify-icon height="24" icon="ic:baseline-tiktok" width="24"></iconify-icon></a>
                        <a class="link-body-emphasis" href="https://www.youtube.com/@smaskartikatamametro"><iconify-icon height="24" icon="mdi:youtube" width="24"></iconify-icon></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <h6 class="mb-32">Informasi</h6>
                    <div class="d-flex flex-column lh-lg">
                        <a class="text-body-secondary text-hover-primary-600 transition-2 p-0" href="{{ route('berita') }}">Berita</a>
                        <a class="text-body-secondary text-hover-primary-600 transition-2 p-0" href="{{ route('foto') }}">Galeri Foto</a>
                        <a class="text-body-secondary text-hover-primary-600 transition-2 p-0" href="{{ route('video') }}">Galeri Video</a>
                        <a class="text-body-secondary text-hover-primary-600 transition-2 p-0" href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <h6 class="mb-32">Akademik</h6>
                    <div class="d-flex flex-column lh-lg">
                        <a class="text-body-secondary text-hover-primary-600 transition-2 p-0" href="{{ route('sejarah') }}">Sejarah</a>
                        <a class="text-body-secondary text-hover-primary-600 transition-2 p-0" href="{{ route('visi-misi') }}">Visi dan Misi</a>
                        <a class="text-body-secondary text-hover-primary-600 transition-2 p-0" href="{{ route('osis') }}">OSIS</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <h6 class="mb-32">PPDB</h6>
                    <div class="d-flex flex-column w-100 gap-4">
                        <a @class([
                            'btn btn-primary-600 rounded-pill radius-50 px-20 py-12',
                            'disabled' => auth()->check(),
                        ]) href="{{ route('info-ppdb') }}">Daftar PPDB</a>
                        <a @class([
                            'btn btn-primary-600 rounded-pill radius-50 px-20 py-12',
                            'disabled' => auth()->check(),
                        ]) href="{{ route('info-ppdb') }}">Syarat PPDB</a>
                    </div>
                </div>
            </div>
            <div class="text-body-secondary border-top mt-72 pt-32 text-center">
                <p>© 2025 HakimDev, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/js/lib/sweetalert2.all.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        const Swal2 = Swal.mixin({
            customClass: {
                title: 'text-lg',
                htmlContainer: 'text-md'
            },
        })
    </script>
    @stack('script')
</body>

</html>
