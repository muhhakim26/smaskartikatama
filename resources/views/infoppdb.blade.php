@extends('layouts.guest.preset')
@section('judul', 'Info PPDB')
@push('style')
    <style>
        .backgroundinfo {
            background-image: url('{{ asset('assets/images/bgpendaftaran1.png') }}');
            background-size: cover;
            background-position: center;
            width: 100%;
        }
    </style>
@endpush
@section('konten')
    @include('layouts.guest.hero', ['judul' => 'Info PPDB'])
    <!-- Info Section -->
    <section class="py-120" id="info">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body lh-lg text-black">
                    <div class="editor p-20">
                        {!! $Infoppdb->deskripsi ?? 'Belum ada informasi.' !!}
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
                                    <a @class([ 'btn rounded-pill btn-primary radius-50 w-100 py-12', 'disabled' => !$value->status_pendaftaran ]) href="{{ $value->status_pendaftaran ? route('ppdb.index', $value->id) : '#' }}">Daftar Batch {{$value->id}}</a>
                                    {{-- blade-formatter-enable --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
