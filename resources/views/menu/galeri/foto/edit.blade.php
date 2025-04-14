@extends('layouts/preset')
@section('judul', 'Ubah Foto')

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
                    <form action="{{ route('kelola-galeri-foto.update', $GaleriFoto->id) }}" autocomplete="off" class="d-flex flex-column gap-20" enctype="multipart/form-data" id="galeri-foto-edit" method="post">
                        @csrf
                        @method('put')
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="nama-foto">Nama Foto</label>
                            <input class="form-control" id="nama-foto" name="nama-foto" type="text" value="{{ old('nama-foto', $GaleriFoto->nama_foto) }}">
                            @error('nama-foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="foto">Foto</label>
                            <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="foto" name="foto" type="file">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary-600 me-1 px-32" type="submit">Simpan</button>
                            <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-galeri-foto.index') }}">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
