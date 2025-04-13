@extends('layouts/preset')
@section('judul', 'Buat Ekstrakurikuler')
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
                    <form action="{{ route('kelola-ekstrakurikuler.store') }}" autocomplete="off" class="d-flex flex-column gap-20" enctype="multipart/form-data" id="ekstrakurikuler-create" method="post">
                        @csrf
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="nama-ekskul">Nama Ekstrakurikuler</label>
                            <input class="form-control" id="nama-ekskul" name="nama-ekskul" type="text" value="{{ old('nama-ekskul') }}">
                            @error('nama-ekskul')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="deskripsi">Deskripsi</label>
                            <div class="radius-8 border border-neutral-200">
                                <!-- Editor Toolbar Start -->
                                <div id="toolbar-container">
                                    <span class="ql-formats">
                                        <select class="ql-font">
                                            <option selected>Inter</option>
                                            <option value="poppins">Poppins</option>
                                        </select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="5"></button>
                                        <button class="ql-blockquote"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-list" value="ordered"></button>
                                        <button class="ql-list" value="bullet"></button>
                                        <button class="ql-indent" value="-1"></button>
                                        <button class="ql-indent" value="+1"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-direction" value="rtl"></button>
                                        <select class="ql-align"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-link"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-clean"></button>
                                    </span>
                                </div>
                                <!-- Editor Toolbar Start -->
                                <!-- Editor start -->
                                <textarea class="form-control d-none" id="deskripsi" name="deskripsi"></textarea>
                                <div id="editor">{!! old('deskripsi') !!}</div>
                                <!-- Edit End -->
                            </div>
                            @error('deskripsi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="foto-struktur">Foto Struktur</label>
                            <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="foto-struktur" name="foto-struktur" type="file">
                            @error('foto-struktur')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="foto-kegiatan">Foto Kegiatan</label>
                            <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="foto-kegiatan" multiple name="foto-kegiatan[]" type="file">
                            @error('foto-kegiatan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary-600 me-1 px-32" type="submit">Simpan</button>
                            <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-ekstrakurikuler.index') }}">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
