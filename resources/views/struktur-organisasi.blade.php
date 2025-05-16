@extends('layouts.guest.preset')
@section('judul', 'Struktur Organisasi')
@section('konten')
    @include('layouts.guest.hero', ['judul' => 'Struktur Organisasi'])
    <!-- Struktur Section -->
    <section class="py-120" id="struktur">
        <div class="container">
            <div class="card lh-lg mb-40 text-base">
                <div class="card-body text-black">
                    <div class="p-20">
                        @if (!empty($StrukturOrganisasi->foto_struktur))
                            <img alt="struktur-organisasi" class="w-100 shadow-5 object-fit-cover" src="{{ asset('img/' . $StrukturOrganisasi->foto_struktur) }}">
                        @else
                            Tidak Ada Gambar
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
