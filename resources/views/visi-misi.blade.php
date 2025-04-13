@extends('layouts/user/preset')
@section('judul', 'Visi dan Misi')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Visi dan Misi'])
    <!-- VisiMisi Section -->
    <section class="py-120" id="visimisi">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body text-black">
                    <div class="p-20">
                        <div class="mb-50">
                            <h5 class="mb-32">Visi</h5>
                            <p class="mb-20">Mewujudkan sekolah yang unggul dalam prestasi berdasarkan Iman dan Taqwa.</p>
                            <p class="fw-semibold text-uppercase mb-20">indikator:</p>
                            <ol class="list-decimal">
                                <li class="mb-16">Unggul dalam perolehan nilai Ujian Nasional</li>
                                <li class="mb-16">Unggul dalam persaingan melanjutkan kejenjang pendidikan yang lebih tinggi</li>
                                <li class="mb-16">Unggul dalam aktifitas keagamaan</li>
                                <li class="mb-16">Unggul dalam lomba olah raga</li>
                                <li class="mb-16">Unggul dalam disiplin Unggul dalam berbahasa Inggris</li>
                            </ol>
                        </div>
                        <div class="mb-50">
                            <h5 class="mb-32">Misi</h5>
                            <ol class="list-decimal">
                                <li class="mb-16">Disiplin waktu, ilmu dan amal soleh</li>
                                <li class="mb-16">Optimalisasi kualitas dan kuantitas siswa untuk studi lanjut ke Perguruan Tinggi Negeri (PTN)</li>
                                <li class="mb-16">Mengembangkan generasi muda yang bertaqwa dan berakhlak mulia</li>
                                <li class="mb-16">Menumbuhkan semangat keunggulan dan bernalar sehat sehingga memiliki komitmen yang kuat untuk terus maju</li>
                                <li class="mb-16">Optimalisasi penggunaan bahasa inggris sebagai bahasa sehari-hari</li>
                                <li class="mb-16">Optimalisasi bidang akademik, olahraga, keterampilan seni dan olah raga</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
