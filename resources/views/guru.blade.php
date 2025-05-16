@extends('layouts.guest.preset')
@section('judul', 'Guru')
@section('konten')
    @push('style')
        <style>
            .img-3-4 {
                width: 100%;
                height: auto;
                aspect-ratio: 3 / 4;
                object-fit: cover;
            }
        </style>
        @include('layouts.guest.hero', ['judul' => 'Guru dan Tendik'])
        <!-- Guru Section -->
        <section class="py-120" id="guru">
            <div class="container">
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
                                            <img alt="{{ $value->nama }}" class="img-fluid img-4-3 rounded-imggurutendik" src="{{ asset('img/' . $value->file_foto) }}">
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
    @endsection
