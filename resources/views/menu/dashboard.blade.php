@extends('layouts/preset')
@section('judul', 'Dasbor')

@section('konten')
    <h1>Selamat Datang, {{ auth()->user()->nama ?? 'Guest' }}</h1>
    <a href="{{ route('admin.ubah-sandi') }}">Ubah Kata Sandi</a>
    <ul>
        <li><a href="{{ route('admin.index') }}">Admin ✅</a></li>
        <li><a href="{{ route('kelola-berita.index') }}">Berita ✅</a></li>
        <li><a href="{{ route('kelola-data-guru.index') }}">Data Guru ✅</a></li>
        <li><a href="{{ route('kelola-ekstrakurikuler.index') }}">Ekstrakurikuler 👀</a></li>
        <li><a href="{{ route('kelola-galeri-foto.index') }}">Galeri Foto ✅</a></li>
        <li><a href="{{ route('kelola-galeri-video.index') }}">Galeri Video 👀</a></li>
        <li><a href="{{ route('kelola-kontak.index') }}">Kontak 👀</a></li>
        <li><a href="{{ route('kelola-ppdb.index') }}">PPDB 👀</a></li>
        <li><a href="{{ route('kelola-osis.index') }}">Osis ✅</a></li>
        <li><a href="{{ route('kelola-sambutan-kepsek.index') }}">Sambutan ✅</a></li>
        <li><a href="{{ route('kelola-sejarah.index') }}">Sejarah ✅</a></li>
        <li><a href="{{ route('kelola-struktur-organisasi.index') }}">Struktur Organisasi ✅</a></li>
        <li><a href="{{ route('kelola-visi-misi.index') }}">Visi Misi ✅</a></li>
    </ul>

    {{-- <form action={{ route('logout') }} method="post">
        @csrf
        <button type="submit">Logout</button>
    </form> --}}
    <a href="" id="logout">Logout</a>
@endsection
@push('js')
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
@endpush
