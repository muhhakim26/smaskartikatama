@extends('layouts.guest.preset')
@section('judul', 'Ekstrakurikuler')
@section('konten')
    @include('layouts.guest.hero', ['judul' => 'Ekstrakurikuler'])
    <!-- Info Section -->
    <section class="py-120" id="Info">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body text-black">
                    <div class="editor p-20">
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
