@extends('layouts/preset')
@section('judul', 'Kelola Struktur Organisasi')
@section('konten')
    <div class="row gy-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-semibold mb-0">Sambuatan Kepala Sekolah Form</h6>
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
                    <form action="{{ route('kelola-struktur-organisasi.store') }}" autocomplete="off" class="d-flex flex-column mt-20 gap-20" enctype="multipart/form-data" id="form" method="post">
                        @csrf
                        <div>
                            <label class="form-label fw-bold text-neutral-900" for="foto-struktur-organisasi">Foto Struktur Organisasi</label>
                            @if (!empty($StrukturOrganisasi->foto_struktur))
                                <div class="position-relative mb-20">
                                    <img alt="struktur strukturOrganisasi" class="w-100 object-fit-cover" src="{{ asset('img/' . $StrukturOrganisasi->foto_struktur) }}">
                                    <a class="position-absolute z-1 text-2xxl line-height-1 d-flex bg-danger-600 w-40-px h-40-px justify-content-center align-items-center rounded-circle end-0 top-0 me-8 mt-8" onclick="hapus({{ $StrukturOrganisasi->id }})" style="cursor:pointer">
                                        <iconify-icon class="text-2xl text-white" icon="radix-icons:cross-2"></iconify-icon>
                                    </a>
                                </div>
                            @endif
                            <input accept="image/jpg, image/png, image/jpeg" class="form-control" form-control id="foto-struktur-organisasi" name="foto-struktur-organisasi" type="file">
                            @error('foto-struktur-organisasi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
