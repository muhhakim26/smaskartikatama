@extends('layouts/user/preset')
@section('judul', 'Info PPDB')
@section('konten')
    @push('style')
        <style>
            .backgroundinfo {
                background-image: url('{{ asset('assets/images/bgpendaftaran1.png') }}');
                background-size: cover;
                background-position: center;
                width: 100%;
            }

            /* ul,
                            ol {
                                list-style: auto;
                                padding-left: 2rem;
                            } */
        </style>
    @endpush
    @include('layouts.user.hero', ['judul' => 'Info PPDB'])
    <!-- Info Section -->
    <section class="py-120" id="info">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body lh-lg text-black">
                    <div class="editor p-20">
                        {!! $Infoppdb->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body lh-lg text-black">
                    <div class="p-20">
                        <h5 class="mb-32">Persyaratan Pendaftaran Calon Siswa Baru PPDB SMAS Kartikatama Metro</h5>
                        <ol class="list-decimal">
                            <li class="mb-16">
                                Formulir Pendaftaran:
                                <ol class="list-style mt-16">
                                    <li class="mb-16">Mengisi formulir pendaftaran yang disediakan (mengisi kertas formulir Pendaftaran jika mendaftar Offline)</li>
                                    <li class="mb-16">Mengisi formulir pendaftaran yang disediakan di laman Pendaftaran PPDB melalui website bagi yang mendaftar Online.</li>
                                </ol>
                            </li>
                            <li class="mb-16">Ijazah SMP</li>
                            <li class="mb-16">Fotokopi Ijazah SMP atau surat keterangan lulus.</li>
                            <li class="mb-16">Akta Kelahiran: Fotokopi akta kelahiran.</li>
                            <li class="mb-16">Kartu Keluarga: Fotokopi Kartu Keluarga (KK).</li>
                            <li class="mb-16">Raport: Fotokopi raport semester terakhir.</li>
                            <li class="mb-16">Pas Foto*: Pas foto terbaru ukuran 3x4.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Schedule Section -->
        <section class="py-16" id="schedule">
            <div class="container">
                <div class="mb-32">
                    <h4>Jadwal PPDB SMAS Kartikatama Metro</h4>
                </div>
                <div class="row gy-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body p-6">
                                <div class="p-20">
                                    <h5 class="mb-36 text-center"><a class="text-uppercase text-line-2 text-primary-600 text-hover-primary-600 transition-2 href="#"><strong>Batch 1</strong></a></h5>
                                    <div class="mb-32 text-black">
                                        <p class="mb-10">Pendaftaran Batch 1</p>
                                        <p class="mb-10">1 Agustus s.d. 30 November 2024</p>
                                        <p class="mb-10">Lokasi: SMAS Kartikatama Metro</p>
                                        <p class="mb-10">Offline: 10.00 WIB sampai 15.00 WIB</p>
                                        <p class="mb-10">Online 24 Jam</p>
                                        {{-- <p class="fst-italic mb-10">* Kuota Pendaftar 150 Orang Siswa</p> --}}
                                    </div>
                                    <a class="btn rounded-pill btn-primary radius-50 w-100 py-12 disabled" href="#">Daftar Batch 1</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body p-6">
                                <div class="p-20">
                                    <h5 class="mb-36 text-center"><a class="text-uppercase text-line-2 text-primary-600 text-hover-primary-600 transition-2 disabled" href="#"><strong>Batch 2</strong></a></h5>
                                    <div class="mb-32 text-black">
                                        <p class="mb-10"><strong>Pendaftaran Batch 2</strong></p>
                                        <p class="mb-10">09 Desember 2024 s.d. 21 Maret 2025</p>
                                        <p class="mb-10">Lokasi: SMAS Kartikatama Metro</p>
                                        <p class="mb-10">Offline: 10.00 WIB sampai 15.00 WIB</p>
                                        <p class="mb-10">Online 24 Jam</p>
                                        {{-- <p class="fst-italic mb-10">* Kuota Pendaftar 150 Orang Siswa</p> --}}
                                    </div>
                                    <a class="btn rounded-pill btn-primary radius-50 w-100 py-12 disabled" href="#">Daftar Batch 2</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body p-6">
                                <div class="p-20">
                                    <h5 class="mb-36 text-center"><a class="text-uppercase text-line-2 text-primary-600 text-hover-primary-600 transition-2 disabled" href={{ route('ppdb') }}><strong>Batch 3</strong></a></h5>
                                    <div class="mb-32 text-black">
                                        <p class="mb-10">Pendaftaran Batch 3</p>
                                        <p class="mb-10">14 April 2025 s.d. 13 Juni 2025</p>
                                        <p class="mb-10">Lokasi: SMAS Kartikatama Metro</p>
                                        <p class="mb-10">Offline: 10.00 WIB sampai 15.00 WIB</p>
                                        <p class="mb-10">Online 24 Jam</p>
                                        {{-- <p class="fst-italic mb-10">* Kuota Pendaftar 150 Orang Siswa</p> --}}
                                    </div>
                                    <a class="btn rounded-pill btn-primary radius-50 w-100 py-12" href="{{ route('ppdb') }}">Daftar Batch 3</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Info Section 2 -->
    <section class="py-120 mb-120 backgroundinfo" id="info">
        <div class="container">
            <div class="max-w-1000-px m-auto">
                <h5 class="text-uppercase fw-bold mb-28 text-white">Layanan Informasi PPDB SMAS Kartikatama Metro</h5>
                <p class="fw-normal mb-28 text-white">Kami menyediakan informasi lengkap dan terkini mengenai Penerimaan Peserta Didik Baru (PPDB) SMAS Kartikatama Metro. Layanan ini dirancang untuk membantu calon siswa dan orang tua memahami alur pendaftaran, persyaratan, jadwal, serta program pendidikan yang ditawarkan oleh sekolah. Dengan pendekatan yang profesional dan responsif, kami berkomitmen untuk memastikan proses pendaftaran berjalan dengan lancar, transparan, dan mudah diakses.</p>
                <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="https://api.whatsapp.com/send?phone=6285888082608&text=Assalamualaikum%2C%20%0ASaya%20telah%20melihat%20informasi%20PPDB%20SMAS%20Kartikatama%20Metro%20dan%20ingin%20menanyakan%20beberapa%20hal%20lebih%20lanjut.">Hubungi Kami</a>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        document.querySelectorAll('.editor h4, .editor h5').forEach((p) => {
            p.classList.add('mb-32'); // Tambahkan class ke <p>
        });
        document.querySelectorAll('.editor p').forEach((p) => {
            p.classList.add('mb-24'); // Tambahkan class ke <p>
        });
        ['ol', 'ul'].forEach((tag) => {
            document.querySelectorAll(`.editor ${tag}`).forEach((c) => {
                c.classList.add(tag === 'ol' ? 'list-decimal' : 'list-style');
                c.querySelectorAll('li').forEach((li) => {
                    li.classList.add('mb-16');
                });
            });
        });
    </script>
@endpush
