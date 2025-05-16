@extends('layouts.admin.preset')
@section('judul', 'Buat Data Guru')
@push('style')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input#nip-guru::-webkit-outer-spin-button,
        input#nip-guru::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number]#nip-guru {
            -moz-appearance: textfield;
        }
    </style>
@endpush
@section('konten')
    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0">Input Form</h6>
                </div>
                <div class="card-body">
                    {{-- blade-formatter-disable --}}
                    @if (session()->has('message'))
                         <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="ep:warning-filled" class="icon text-xl"></iconify-icon>
                                {{ session()->get('message') }}
                            </div>
                            <button class="remove-button text-danger-600 text-xxl line-height-1">
                                <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                            </button>
                        </div>
                    @endif
                    {{-- blade-formatter-enable --}}
                    <form action="{{ route('kelola-data-guru.store') }}" autocomplete="off" class="d-flex flex-column gap-20" enctype="multipart/form-data" id="dataguru-create" method="post">
                        @csrf
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="nama-guru">Nama Guru</label>
                            <input class="form-control" id="nama-guru" name="nama-guru" type="text" value="{{ old('nama-guru') }}">
                            @error('nama-guru')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="nip-guru">Nomor Induk Pegawai (NIP)</label>
                            <input class="form-control" id="nip-guru" name="nip-guru" required type="number" value="{{ old('nip-guru') }}">
                            @error('nip-guru')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="bidang-guru">Bidang</label>
                            <input class="form-control" id="bidang-guru" name="bidang-guru" type="text" value="{{ old('bidang-guru') }}">
                            @error('bidang-guru')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="jabatan-guru">Jabatan</label>
                            <input class="form-control" id="jabatan-guru" name="jabatan-guru" type="text" value="{{ old('jabatan-guru') }}">
                            @error('jabatan-guru')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="foto-guru">Foto Guru</label>
                            <input accept="image/jpg, image/png, image/jpeg" id="foto-guru" name="foto-guru" type="file">
                            @error('foto-guru')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary-600 me-1 px-32" type="submit">Simpan</button>
                            <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-data-guru.index') }}">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        const $input = $('input#nip-guru');

        let $valueBeforeInput = $input.val();
        $input.on('input', function(event) {
            if ($(this).val().length > 18) {
                $(this).val($valueBeforeInput);
            }
            $valueBeforeInput = $(this).val();
        });
    </script>
@endpush
