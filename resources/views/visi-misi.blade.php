@extends('layouts/user/preset')
@section('judul', 'Visi dan Misi')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Visi dan Misi'])
    <!-- VisiMisi Section -->
    <section class="py-120" id="visimisi">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body text-black">
                    <div class="editor p-20">
                        {!! $VisiMisi->deskripsi !!}
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
