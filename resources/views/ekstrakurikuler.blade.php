@extends('layouts/user/preset')
@section('judul', 'Ekstrakurikuler')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Ekstrakurikuler'])
    <!-- Ekstrakurikuler Section -->
    <section class="py-120" id="ekstrakurikuler">
        <div class="container">
            <div class="row gy-4">
                @if ($Ekstrakurikuler->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <p class="24">
                        <h6 class="fw-bold text-secondary">Tidak Ada Ekstrakurikuler</h6>
                        </p>
                    </div>
                @else
                    @foreach ($Ekstrakurikuler as $value)
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-body p-0">
                                    <a class="w-100 max-h-266-px radius-0 overflow-hidden" href="{{ route('infoekstrakurikuler', $value->id) }}">
                                        <img alt="{{ $value->nama }}"class="w-100 h-100 object-fit-cover" src="{{ asset('img/' . $value) }}">
                                    </a>
                                    <div class="p-20 text-center">
                                        <h6 class="card-title mb-10"><a class="text-line-2 text-hover-primary-600 transition-2 text-capitalize text-xl" href="{{ route('infoekstrakurikuler', $value->id) }}">{{ $value->nama }}</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mt-24">
                {{ $Ekstrakurikuler->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
