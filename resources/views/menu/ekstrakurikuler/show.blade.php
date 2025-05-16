@extends('layouts.admin.preset')
@section('judul', 'Deskripsi Ekstrakurikuler')

@section('konten')
    <div class="card h-100 radius-12 p-0">
        <div class="card-header border-bottom bg-base px-24 py-16">
            <h6 class="fw-semibold mb-0">Deskripsi Ekstrakurikuler</h6>
        </div>
        <div class="card-body p-24">
            {{-- blade-formatter-disable --}}
            @if (session()->has('message'))
                 <div class="alert alert-success bg-success-100 text-success-600 border-success-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="akar-icons:double-check" class="icon text-xl"></iconify-icon>
                        {{ session()->get('message') }}
                    </div>
                    <button class="remove-button text-success-600 text-xxl line-height-1">
                        <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                    </button>
                </div>
            @endif
            {{-- blade-formatter-enable --}}
            <table>
                <tr>
                    <td class="w-76-px"><span class="text-md fw-semibold text-primary-light">Nama</span></td>
                    <td class="w-20-px">:</td>
                    <td><span class="text-secondary-light fw-medium">{{ $Ekstrakurikuler->nama }}</span></td>
                </tr>
                {{-- <tr>
                    <td><span class="text-md fw-semibold text-primary-light">Deskripsi</span></td>
                    <td>:</td>
                    <td><span class="text-secondary-light fw-medium">{!! $Ekstrakurikuler->deskripsi !!}</span></td>
                </tr> --}}
                <tr>
                    <td><span class="text-md fw-semibold text-primary-light">Foto</span></td>
                    <td>:</td>
                    <td><span class="text-secondary-light fw-medium"><img alt="{{ $Ekstrakurikuler->nama }}" src="{{ asset('img/' . $Ekstrakurikuler->foto_struktur) }}"></span></td>
                </tr>
                <tr>
                    <td><span class="text-md fw-semibold text-primary-light">Dibuat</span></td>
                    <td>:</td>
                    <td><span class="text-secondary-light fw-medium">{{ $Ekstrakurikuler->created_at }}</span></td>
                </tr>
                <tr>
                    <td><span class="text-md fw-semibold text-primary-light">Diubah</span></td>
                    <td>:</td>
                    <td><span class="text-secondary-light fw-medium">{{ $Ekstrakurikuler->updated_at }}</span></td>
                </tr>
            </table>
            <div class="d-flex justify-content-between mt-24">
                <div>
                    <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-ekstrakurikuler.index') }}">Kembali</a>
                </div>
                <div>
                    <a class="btn btn-primary-600 me-1 px-32" href="{{ route('kelola-ekstrakurikuler.edit', $Ekstrakurikuler->id) }}">Ubah</a>
                </div>
            </div>
        </div>
    </div>
@endsection
