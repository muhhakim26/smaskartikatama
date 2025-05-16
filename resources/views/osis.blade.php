@extends('layouts.guest.preset')
@section('judul', 'OSIS')
@section('konten')
    @include('layouts.guest.hero', ['judul' => 'OSIS'])
    <!-- Organisasi Section -->
    <section class="py-120" id="organisasi">
        <div class="container">
            <div class="card lh-lg mb-40 text-base">
                <div class="card-body text-black">
                    <div class="editor p-20">
                        {!! $OSIS->deskripsi ?? 'Data Kosong' !!}
                    </div>
                </div>
            </div>
            <div class="card mb-40">
                <div class="card-body">
                    <div class="p-20">
                        <h5 class="mb-32">Struktur Organisasi</h5>
                        @if (!empty($OSIS->foto_struktur))
                            <img alt="struktur-organisasi" class="w-100 shadow-5 object-fit-cover" src="{{ asset('img/' . $OSIS->foto_struktur) }}">
                        @else
                            Tidak Ada Gambar
                        @endif
                    </div>
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
