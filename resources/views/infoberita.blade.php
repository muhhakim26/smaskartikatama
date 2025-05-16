@extends('layouts.guest.preset')
@section('judul', $Berita)
@section('konten')
    @include('layouts.guest.hero', ['judul' => 'Berita'])
    <!-- Info Section -->
    <section class="py-120" id="info">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="p-20">
                        <img alt="thumbnail" class="w-100 radius-10 shadow-5 max-h-612-px object-fit-cover mb-32" src="{{ asset('img/' . $Berita->file_foto) }}">
                        <h4 class="mb-32">{{ $Berita->judul }}</h4>
                        {!! $Berita->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
