@extends('layouts.guest.preset')
@section('judul', 'Galeri Video')
@section('konten')
    @include('layouts.guest.hero', ['judul' => 'Galeri Video'])
    <!-- Video Section -->
    <section class="py-120" id="video">
        <div class="container">
            <div class="row gy-4">
                @if ($GaleriVideo->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <p class="24">
                        <h6 class="fw-bold text-secondary">Tidak Ada Video Terbaru</h6>
                        </p>
                    </div>
                @else
                    @foreach ($GaleriVideo as $key => $value)
                        <div class="col-xxl-4 col-sm-6">
                            <div class="bg-base radius-8 overflow-hidden border">
                                <div class="position-relative max-h-258-px overflow-hidden">
                                    <a class="w-100" href="#">
                                        <img alt="thumbnail-{{ $key++ }}" class="w-100 object-fit-cover" src="{{ asset('img/' . $value->thumbnail) }}">
                                    </a>
                                    <a class="magnific-video bordered-shadow w-56-px h-56-px rounded-circle d-flex justify-content-center align-items-center position-absolute start-50 top-50 translate-middle z-1 bg-white" href="{{ $value->file_video }}">
                                        <iconify-icon class="text-primary-600 text-xxl" icon="ion:play"></iconify-icon>
                                    </a>
                                </div>
                                <a href="#">
                                    <div class="p-16">
                                        <h6 class="text-line-2 mb-6 text-xl">{{ $value->judul_video }}</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mt-24">
                {{ $GaleriVideo->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(".magnific-video").magnificPopup({
            type: "iframe"
        });
    </script>
@endpush
