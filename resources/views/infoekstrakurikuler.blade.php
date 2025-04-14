@extends('layouts/user/preset')
@section('judul', 'Ekstrakurikuler')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Ekstrakurikuler'])
    <!-- Info Section -->
    <section class="py-120" id="Info">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body text-black">
                    <div class="p-20">
                        <div class="mb-50">
                            {{-- h4.mb-32, h5.mb-32, p.mb-24, ol.list-decimal, li.mb-16 --}}
                            {!! $Ekstrakurikuler->deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-40">
                <div class="card-body">
                    <div class="p-20">
                        <h5 class="mb-32">Struktur Organisasi</h5>
                        <img alt="struktur-organisasi" class="w-100 shadow-5 object-fit-cover" src="{{ asset('img/' . $Ekstrakurikuler->foto_struktur) }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
