@extends('layouts.admin.preset')
@section('judul', 'Info PPDB')
@push('style')
    <style>
        .ql-font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>
@endpush
@section('konten')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0">Info PPDB Form</h6>
                </div>
                <div class="card-body">
                    {{-- blade-formatter-disable --}}
                    @if (session()->has('message'))
                        @if (session()->get('hasError'))
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 py-13 fw-semibold radius-4 d-flex align-items-center justify-content-between mb-0 px-24 text-lg" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon class="icon text-xl" icon="ep:warning-filled"></iconify-icon>
                                    {{ session()->get('message') }}
                                </div>
                                <button class="remove-button text-danger-600 text-xxl line-height-1">
                                    <iconify-icon class="icon" icon="iconamoon:sign-times-light"></iconify-icon>
                                </button>
                            </div>
                        @else
                            <div class="alert alert-success bg-success-100 text-success-600 border-success-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 py-13 fw-semibold radius-4 d-flex align-items-center justify-content-between mb-0 px-24 text-lg" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon class="icon text-xl" icon="ep:success-filled"></iconify-icon>
                                    {{ session()->get('message') }}
                                </div>
                                <button class="remove-button text-success-600 text-xxl line-height-1">
                                    <iconify-icon class="icon" icon="iconamoon:sign-times-light"></iconify-icon>
                                </button>
                            </div>
                        @endif
                    @endif
                    <form action="{{ route('kelola-info-ppdb.store') }}" autocomplete="off" class="d-flex flex-column mt-20 gap-20" id="form" method="post">
                        @csrf
                        <div>
                            @error('deskripsi-info-ppdb')
                                <div class="text-danger">{{ $message }}</div>
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
                                <textarea class="form-control d-none" id="deskripsi" name="deskripsi-info-ppdb"></textarea>
                                <div id="editor">{!! old('deskripsi-info-ppdb', $InfoPpdb->deskripsi ?? '') !!}</div>
                                <!-- Edit End -->
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary-600 me-1 px-32" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
