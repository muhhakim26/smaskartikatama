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
    <!-- Data Table css -->
    <link href="{{ asset('assets/css/lib/dataTables.min.css') }}" rel="stylesheet">
    <!-- Text Editor css -->
    <link href="{{ asset('assets/css/lib/editor.quill.snow.css') }}" rel="stylesheet">
    <!-- Date picker css -->
    <link href="{{ asset('assets/css/lib/flatpickr.min.css') }}" rel="stylesheet">
    <!-- Popup css -->
    <link href="{{ asset('assets/css/lib/magnific-popup.css') }}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="{{ asset('assets/css/lib/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- main css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Font For Quill -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* === Custom Quill Editor === */
        #toolbar-container .ql-formats .ql-color-picker svg,
        #toolbar-container .ql-formats .ql-icon-picker svg {
            vertical-align: baseline;
        }

        #editor {
            font-family: "Inter";
            font-size: 16px;
            height: 175px;
        }

        .ql-editor {
            border-radius: 12px;
            min-height: auto;
        }

        .ql-picker-label,
        .ql-formats {
            color: var(--text-primary-light);
            z-index: unset;
        }

        .ql-font-poppins {
            font-family: "Poppins";
        }
    </style>
    @stack('style')
</head>

<body>

    @if (Route::is('dashboard*', 'profil*', 'admin*', 'kelola*') && !Route::currentRouteNamed('admin.login'))
        <aside class="sidebar">
            <button class="sidebar-close-btn" type="button">
                <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
            </button>
            <div>
                <a class="sidebar-logo" href="{{ route('home') }}">
                    <img alt="site logo" class="light-logo" src="{{ asset('assets/images/logo-smas-kartikatama-metro.svg') }}">
                    <img alt="site logo" class="dark-logo" src="assets/images/logo-smas-kartikatama-metro.svg">
                    <img alt="site logo" class="logo-icon" src="assets/images/logo-smas-kartikatama-metro.svg">
                </a>
            </div>
            <div class="sidebar-menu-area">
                <ul class="sidebar-menu" id="sidebar-menu">
                    <li @class(['active-page' => Route::is('dashboard*')])>
                        <a @class(['active-page' => Route::is('dashboard*')]) href="{{ route('dashboard') }}">
                            <iconify-icon class="menu-icon" icon="solar:home-smile-angle-outline"></iconify-icon>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @can('isSuperAdmin')
                        <li @class(['active-page' => Route::is('kelola-admin*')])>
                            <a @class(['active-page' => Route::is('kelola-admin*')]) href="{{ route('kelola-admin.index') }}">
                                <iconify-icon class="menu-icon" icon="mdi:shield-user-outline"></iconify-icon>
                                <span>Admin</span>
                            </a>
                        </li>
                    @endcan
                    <li @class(['active-page' => Route::is('kelola-berita*')])>
                        <a @class(['active-page' => Route::is('kelola-berita*')]) href="{{ route('kelola-berita.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:newspaper-variant-multiple"></iconify-icon>
                            <span>Berita</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-data-guru*')])>
                        <a @class(['active-page' => Route::is('kelola-data-guru*')]) href="{{ route('kelola-data-guru.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:user-multiple-outline"></iconify-icon>
                            <span>Data Guru</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-ekstrakurikuler*')])>
                        <a @class(['active-page' => Route::is('kelola-ekstrakurikuler*')]) href="{{ route('kelola-ekstrakurikuler.index') }}"">
                            <iconify-icon class="menu-icon" icon="material-symbols:map-outline"></iconify-icon>
                            <span>Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelolkelola-galeri-fotoa*')])>
                        <a @class(['active-page' => Route::is('kelola-galeri-foto*')]) href="{{ route('kelola-galeri-foto.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:photo-library"></iconify-icon>
                            <span>Galeri Foto</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-galeri-video*')])>
                        <a @class(['active-page' => Route::is('kelola-galeri-video*')]) href="{{ route('kelola-galeri-video.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:library-video"></iconify-icon>
                            <span>Galeri Video</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-kontak*')])>
                        <a @class(['active-page' => Route::is('kelola-kontak*')]) href="{{ route('kelola-kontak.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:contact-phone-outline"></iconify-icon>
                            <span>Kontak</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-info-ppdb*')])>
                        <a @class(['active-page' => Route::is('kelola-info-ppdb*')]) href="{{ route('kelola-info-ppdb.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:form-outline"></iconify-icon>
                            <span>Info PPDB</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-ppdb*')])>
                        <a @class(['active-page' => Route::is('kelola-ppdb*')]) href="{{ route('kelola-ppdb.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:database-alert-outline"></iconify-icon>

                            <span>PPDB</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-osis*')])>
                        <a @class(['active-page' => Route::is('kelola-osis*')]) href="{{ route('kelola-osis.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:user-network-outline"></iconify-icon>
                            <span>Osis</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-sambutan-kepsek*')])>
                        <a @class(['active-page' => Route::is('kelola-sambutan-kepsek*')]) href="{{ route('kelola-sambutan-kepsek.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:image-description"></iconify-icon>
                            <span>Sambutan</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-sejarah*')])>
                        <a @class(['active-page' => Route::is('kelola-sejarah*')]) href="{{ route('kelola-sejarah.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:historic"></iconify-icon>
                            <span>Sejarah</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-struktur-organisasi*')])>
                        <a @class(['active-page' => Route::is('kelola-struktur-organisasi*')]) href="{{ route('kelola-struktur-organisasi.index') }}">
                            <iconify-icon class="menu-icon" height="24" icon="mdi:user-network-outline" width="24"></iconify-icon>
                            <span>Struktur Organisasi</span>
                        </a>
                    </li>
                    <li @class(['active-page' => Route::is('kelola-visi-misi*')])>
                        <a @class(['active-page' => Route::is('kelola-visi-misi*')]) href="{{ route('kelola-visi-misi.index') }}">
                            <iconify-icon class="menu-icon" icon="mdi:order-alphabetical-descending"></iconify-icon>
                            <span>Visi Misi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <main class="dashboard-main">
            <div class="navbar-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <div class="d-flex align-items-center flex-wrap gap-4">
                            <button class="sidebar-toggle" type="button">
                                <iconify-icon class="icon non-active text-2xl" icon="heroicons:bars-3-solid"></iconify-icon>
                                <iconify-icon class="icon active text-2xl" icon="iconoir:arrow-right"></iconify-icon>
                            </button>
                            <button class="sidebar-mobile-toggle" type="button">
                                <iconify-icon class="icon" icon="heroicons:bars-3-solid"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <!-- Profile dropdown end -->
                            <div class="dropdown">
                                <button class="d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="dropdown" type="button">
                                    <img alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle" src="{{ asset('assets/images/logosmaskartikatamametro.png') }}">
                                </button>
                                <div class="dropdown-menu to-top dropdown-menu-sm">
                                    <div class="radius-8 bg-primary-50 d-flex align-items-center justify-content-between mb-16 gap-2 px-16 py-12">
                                        <div>
                                            <h6 class="text-primary-light fw-semibold mb-2 text-lg">{{ auth()->user()->nama }}</h6>
                                            <span class="text-secondary-light fw-medium text-sm">{{ auth()->user()->level }}</span>
                                        </div>
                                        <button class="hover-text-danger" type="button">
                                            <iconify-icon class="icon text-xl" icon="radix-icons:cross-1"></iconify-icon>
                                        </button>
                                    </div>
                                    <ul class="to-top-list">
                                        <li>
                                            <a class="dropdown-item hover-bg-transparent hover-text-primary d-flex align-items-center gap-3 px-0 py-8 text-black" href="{{ route('profil') }}">
                                                <iconify-icon class="icon text-xl" icon="solar:user-linear"></iconify-icon> My Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item hover-bg-transparent hover-text-danger d-flex align-items-center gap-3 px-0 py-8 text-black" href="{{ route('logout') }}" id="logout">
                                                <iconify-icon class="icon text-xl" icon="lucide:power"></iconify-icon> Log Out
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-main-body">
                @yield('konten')
            </div>
            <footer class="d-footer">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <p class="mb-0">© 2024 HakimDev. All Rights Reserved.</p>
                    </div>
                    <div class="col-auto">
                        <p class="mb-0">Made by <span class="text-primary-600">🩷</span></p>
                    </div>
                </div>
            </footer>
        </main>
    @else
        @yield('konten')
    @endif
    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Data Table js -->
    <script src="{{ asset('assets/js/lib/dataTables.min.js') }}"></script>
    <!-- Text Editor js -->
    <script src="{{ asset('assets/js/editor.quill.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- jQuery UI js -->
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('assets/js/lib/sweetalert2.all.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Quill Init -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- remove button -->
    <script>
        $(".remove-button").on("click", function() {
            $(this).closest(".alert").addClass("d-none")
        });
    </script>
    <!-- alert swal -->
    <script>
        const Swal2 = Swal.mixin({
            customClass: {
                title: 'text-lg',
                htmlContainer: 'text-md'
            },
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#logout').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('logout') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.status === "redirect") {
                            window.location.href = data.url;
                        }
                    }
                });
            });
        });
    </script>
    @stack('script')
</body>

</html>
