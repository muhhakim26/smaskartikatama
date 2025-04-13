@extends('layouts/preset')
@section('judul', 'Buat Berita')
@section('konten')
    <div class="row gy-4">
        <div class="col-12">
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
                    <form action="{{ route('kelola-berita.store') }}" class="d-flex flex-column gap-20" enctype="multipart/form-data" id="berita-create" method="post">
                        @csrf
                        <div>
                            <label class="form-label fw-bold text-neutral-900" id="judul-berita">Judul</label>
                            <input class="form-control" id="judul-berita" name="judul-berita" type="text" value="{{ old('judul-berita') }}">
                            @error('judul-berita')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="upload-file">Thumbnail</label>
                            @error('foto-berita')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="upload-image-wrapper">
                                <div class="uploaded-img d-none position-relative h-200-px w-100 input-form-light radius-8 overflow-hidden border border-dashed bg-neutral-50">
                                    <button class="uploaded-img__remove position-absolute z-1 text-2xxl line-height-1 d-flex bg-danger-600 w-40-px h-40-px justify-content-center align-items-center rounded-circle end-0 top-0 me-8 mt-8" type="button">
                                        <iconify-icon class="text-2xl text-white" icon="radix-icons:cross-2"></iconify-icon>
                                    </button>
                                    <img alt="image" class="w-100 h-100 object-fit-cover" id="uploaded-img__preview">
                                </div>
                                <label class="upload-file h-160-px w-100 input-form-light radius-8 bg-hover-neutral-200 d-flex align-items-center flex-column justify-content-center gap-1 overflow-hidden border border-dashed bg-neutral-50" for="upload-file">
                                    <iconify-icon class="text-secondary-light text-xl" icon="solar:camera-outline"></iconify-icon>
                                    <span class="fw-semibold text-secondary-light">Upload</span>
                                    <input accept="image/jpg, image/png, image/jpeg" hidden id="upload-file" name="foto-berita" type="file">
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" id="kutipan-berita">Kutipan</label>
                            <textarea class="form-control" id="kutipan-berita" name="kutipan-berita">{{ old('kutipan-berita') }}</textarea>
                            @error('kutipan-berita')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="deskripsi">Deskripsi</label>
                            @error('deskripsi-berita')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                <textarea class="form-control d-none" id="deskripsi" name="deskripsi-berita"></textarea>
                                <div id="editor">{!! old('deskripsi-berita') !!}</div>
                                <!-- Edit End -->
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary-600 me-1 px-32" type="submit">Simpan</button>
                            <a class="btn btn-neutral-400 px-32" href="{{ route('kelola-berita.index') }}">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
