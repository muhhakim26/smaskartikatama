@extends('layouts/preset')
@section('judul', 'Buat Osis')

@section('konten')
    <div class="row gy-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0">OSIS Form</h6>
                </div>
                <div class="card-body">
                    {{-- blade-formatter-disable --}}
                    @if (session()->has('message'))
                        @if(session()->get('hasError'))
                            <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="ep:warning-filled" class="icon text-xl"></iconify-icon>
                                    {{ session()->get('message') }}
                                </div>
                                <button class="remove-button text-danger-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                       @else
                            <div class="alert alert-success bg-success-100 text-success-600 border-success-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-0 fw-semibold text-lg radius-4 d-flex align-items-center justify-content-between" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <iconify-icon icon="ep:success-filled" class="icon text-xl"></iconify-icon>
                                        {{ session()->get('message') }}
                                </div>
                                <button class="remove-button text-success-600 text-xxl line-height-1">
                                    <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                                </button>
                            </div>
                         @endif
                    @endif
                    {{-- blade-formatter-enable --}}
                    <form action="{{ route('kelola-osis.store') }}" autocomplete="off" class="d-flex flex-column mt-20 gap-20" enctype="multipart/form-data" id="osis-create" method="post">
                        @csrf
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="foto-struktur-osis">Foto Struktur OSIS</label>
                            @if (!empty($OSIS->foto_struktur))
                                <div class="position-relative mb-20">
                                    <img alt="struktur osis" class="w-100 object-fit-cover" src="{{ asset('img/' . $OSIS->foto_struktur) }}">
                                    <a class="position-absolute z-1 text-2xxl line-height-1 d-flex bg-danger-600 w-40-px h-40-px justify-content-center align-items-center rounded-circle end-0 top-0 me-8 mt-8" onclick="hapus({{ $OSIS->id }})" style="cursor:pointer">
                                        <iconify-icon class="text-2xl text-white" icon="radix-icons:cross-2"></iconify-icon>
                                    </a>
                                </div>
                            @endif
                            <input accept="image/jpg, image/png, image/jpeg" class="form-control" id="foto-struktur-osis" name="foto-struktur-osis" type="file">
                            @error('foto-struktur-osis')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="deskripsi">Deskripsi</label>
                            @error('deskripsi-osis')
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
                                <textarea class="form-control d-none" id="deskripsi" name="deskripsi-osis"></textarea>
                                <div id="editor">{!! old('deskripsi-osis', $OSIS->deskripsi ?? '') !!}</div>
                                <!-- Edit End -->
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary-600 px-32" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function hapus(id) {
            Swal2.fire({
                title: "Yakin hapus?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                showLoaderOnConfirm: true,
                reverseButtons: true,
                preConfirm: async () => {
                    try {
                        const url = window.location.href + '/' + id;
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                "X-Requested-With": "XMLHttpRequest",
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                            },
                            body: JSON.stringify({
                                "_method": "DELETE"
                            })
                        });
                        const res = await response.json();
                        if (!response.ok) {
                            Swal2.fire({
                                title: "Dibatalkan!",
                                text: res.data,
                                icon: "error",
                            });
                            return false;
                        }
                        return res;
                    } catch (error) {
                        Swal2.showValidationMessage(`Request failed: ${error}`);
                    }
                },
                allowOutsideClick: () => !Swal2.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal2.fire({
                        title: "Dihapus!",
                        text: result.value.data,
                        icon: "success",
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    </script>
@endpush
