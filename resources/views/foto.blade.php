@extends('layouts/user/preset')
@section('judul', 'Galeri Foto')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Galeri Foto'])
    <!-- Foto Section -->
    <section class="py-120" id="foto">
        <div class="container">
            <div class="row gy-4">
                @if ($GaleriFoto->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <p class="24">
                        <h6 class="fw-bold text-secondary">Tidak Ada Foto Terbaru</h6>
                        </p>
                    </div>
                @else
                    @foreach ($GaleriFoto as $value)
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img radius-16 overflow-hidden border">
                                <div class="max-h-266-px overflow-hidden">
                                    <img alt="{{ $value->nama_foto }}" class="hover-scale-img__img w-100 h-100 object-fit-cover" src="{{ asset('img/' . $value->file_foto) }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mt-24">
                {{ $GaleriFoto->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
