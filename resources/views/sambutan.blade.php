@extends('layouts/user/preset')
@section('judul', 'Sambutan Kepala Sekolah')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Informasi Kontak'])
    <!-- Sambutan Section -->
    <section class="py-120" id="sambuatan">
        <div class="container text-base">
            <div class="card">
                <div class="card-body text-black">
                    <div class="p-20">
                        <div class="row g-5">
                            <div class="col-md-4">
                                <div class="flex-shrink-1">
                                    <div class="position-relative">
                                        <img alt="kepala-sekolah" class="w-100 mw-100" src="{{ asset('img/' . $DataGuru->file_foto) }}">
                                    </div>
                                    <h6 class="fw-semibold mt-16 text-center">{{ $DataGuru->nama }}</h6>
                                </div>
                            </div>
                            <div class="col-md-8">
                                {!! $SambutanKepsek->deskripsi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
