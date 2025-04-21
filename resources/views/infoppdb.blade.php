@extends('layouts/user/preset')
@section('judul', 'Info PPDB')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Info PPDB'])
    <!-- Info Section -->
    <section class="py-120" id="info">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body lh-lg text-black">
                    <div class="p-20">
                        <h4 class="mb-32">Penerimaan Peserta Didik Baru SMAS Kartikatama Metro</h4>
                        <p class="mb-20">PPDB di SMAS Kartikatama Metro adalah sebuah kegiatan seleksi yang dirancang khusus untuk memberikan kesempatan kepada calon siswa dari tingkat SMP/MTs kelas 9. Dalam proses seleksi ini, kami mengutamakan keadilan dan transparansi dengan menggunakan kombinasi Nilai Raport dan ujian yang diselenggarakan oleh Panitia PPDB. Hal ini bertujuan untuk memastikan bahwa setiap siswa yang diterima memiliki kemampuan akademik yang memadai dan siap untuk menghadapi
                            tantangan di jenjang pendidikan yang lebih tinggi.</p>
                        <p class="mb-20">SMAS Kartikatama Metro juga berkomitmen untuk mendukung perkembangan siswa melalui berbagai program beasiswa yang tersedia. Kami menyediakan beberapa jenis beasiswa, antara lain:</p>
                        <ol class="list-decimal">
                            <li class="mb-16">Beasiswa Prestasi</li>
                            <li class="mb-16">Beasiswa Perguruan</li>
                            <li class="mb-16">Beasiswa Antar Teman</li>
                        </ol>
                        <p class="mb-20">Lebih istimewanya lagi, SMAS Kartikatama Metro menyediakan program beasiswa yang sangat berharga bagi siswa yatim-piatu, yaitu GRATIS SELURUH BIAYA SEKOLAH SELAMA 3 TAHUN BAGI SISWA YATIM-PIATU . Kami percaya bahwa setiap anak berhak mendapatkan pendidikan yang berkualitas, tanpa terkendala oleh kondisi ekonomi.</p>
                        <p class="mb-20">Kami mengajak para siswa dan orang tua untuk bergabung dalam komunitas belajar yang penuh semangat dan inovasi di SMAS Kartikatama Metro. Dengan berbagai fasilitas dan program unggulan yang kami tawarkan, kami siap mendukung setiap langkah perjalanan pendidikan Anda. Mari wujudkan impian bersama di SMAS Kartikatama Metro! </p>
                        <p class="mb-20">SMAS Kartikatama Metro, kami menyediakan fasilitas unggulan untuk mendukung proses belajar mengajar yang optimal:</p>
                        <ol class="list-decimal">
                            <li class="mb-16">Ruang Belajar Nyaman: Ruang kelas yang sejuk dan representatif untuk menciptakan suasana belajar yang kondusif.</li>
                            <li class="mb-16">Ruang Praktik Komputer: Dilengkapi dengan teknologi terkini untuk meningkatkan keterampilan digital siswa.</li>
                            <li class="mb-16">Masjid Al-Ikhlas: Tempat ibadah yang nyaman untuk mendukung kegiatan spiritual.</li>
                            <li class="mb-16">Gedung Serbaguna: Ruang multifungsi untuk berbagai kegiatan ekstrakurikuler dan acara sekolah</li>
                            <li class="mb-16">Laboratorium IPA: Fasilitas lengkap untuk menjelajahi dunia sains.</li>
                            <li class="mb-16">Laboratorium Bahasa: Meningkatkan kemampuan berbahasa asing dengan metode yang interaktif.</li>
                            <li class="mb-16">Perpustakaan: Sumber pengetahuan yang kaya untuk mendukung belajar mandiri.</li>
                            <li class="mb-16">Kantin Bersih: Menyediakan makanan sehat dan bergizi untuk siswa.</li>
                            <li class="mb-16">Asrama/Pondok: Tempat tinggal yang nyaman bagi siswa yang membutuhkan.</li>
                            <li class="mb-16">Internet/Hotspot: Akses mudah ke informasi dan sumber belajar online.
                            <li class="mb-16">Lapangan Basket, Voli, dan Futsal: Fasilitas olahraga yang mendukung kegiatan fisik dan kerja sama tim.</li>
                        </ol>
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
        <div>



            <div class="card mb-40 text-base">
                <div class="card-body">
                    <div class="p-20">
                        <h5 class="mb-32">Jadwal PPDB SMAS Kartikatama Metro</h5>
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <div class="card shadow">
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
                                <div class="card shadow">
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
                                <div class="card shadow">
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
                </div>
            </div>
        </div>
    </section>
    <!-- Info Section 2 -->
    <section class="py-120 mb-120 bg-black" id="info">
        <div class="container">
            <div class="max-w-1000-px m-auto">
                <h5 class="text-uppercase fw-bold mb-28 text-white">Layanan Informasi PPDB SMAS Kartikatama Metro</h5>
                <p class="fw-normal mb-28 text-white">Memberikan informasi lengkap dan terkini tentang Penerimaan Peserta Didik Baru (PPDB) SMA, kami siap membantu calon siswa dan orang tua memahami alur pendaftaran, persyaratan, jadwal, serta pilihan sekolah terbaik. Dengan layanan profesional dan responsif, kami hadir untuk memastikan proses pendaftaran berjalan lancar dan transparan.</p>
                <a class="btn rounded-pill btn-primary radius-50 px-28 py-12" href="#">Hubungi Kami</a>
            </div>
        </div>
    </section>
@endsection
