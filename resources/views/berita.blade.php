@extends('layouts/user/preset')
@section('judul', $Berita)
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Berita'])
    <!-- Berita Section -->
    <section class="py-120" id="berita">
        <div class="container">
            <div class="row g-4">
                @if ($Berita->isEmpty())
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <h6 class="fw-bold text-secondary">Tidak Ada Berita Terbaru</h6>
                    </div>
                @else
                    @foreach ($Berita as $value)
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body p-0">
                                    <a class="w-100 max-h-266-px radius-0 overflow-hidden" href="{{ route('berita', $value->id) }}">
                                        <img alt="{{ $value->judul }}" class="w-100 h-100 object-fit-cover" src="{{ asset('img/' . $value->file_foto) }}">
                                    </a>
                                    <div class="editor p-20">
                                        <h5 class="card-title mb-16"><a class="text-line-2 text-hover-primary-600 transition-2 text-xl" href="{{ route('infoberita', $value->id) }}">{{ $value->judul }}</a></h5>
                                        <p class="card-text text-line-3">{{ $value->kutipan }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-body-secondary">{{ $value->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="mt-24">
                {{ $Berita->links('pagination::bootstrap-5') }}
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
