@extends('layouts/user/preset')
@section('judul', 'Visi dan Misi')
@section('konten')
    @include('layouts.user.hero', ['judul' => 'Visi dan Misi'])
    <!-- VisiMisi Section -->
    <section class="py-120" id="visimisi">
        <div class="container">
            <div class="card lh-sm mb-40 text-base">
                <div class="card-body text-black">
                    <div class="p-20">
                        {!! $VisiMisi->deskripsi !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
