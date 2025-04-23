@extends('layouts/preset')
@section('judul', 'Kelola Galeri Foto')
@section('konten')
    <div class="card h-100 radius-12 basic-data-table p-0">
        <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between flex-wrap gap-3 px-24 py-16">
            <div class="d-flex align-items-center flex-wrap gap-3">
                <h6 class="fw-semibold mb-0">Kelola Galeri Foto</h6>
            </div>
            <a class="btn btn-primary btn-sm radius-8 d-flex align-items-center gap-2 px-12 py-12 text-sm" href="{{ route('kelola-galeri-foto.create') }}">
                <iconify-icon class="icon line-height-1 text-xl" icon="ic:baseline-plus"></iconify-icon>
                Buat
            </a>
        </div>
        <div class="card-body p-24">
            <div class="row gy-4">
                @foreach ($GaleriFoto as $key => $value)
                    <div class="col-xxl-3 col-md-4 col-sm-6">
                        <div class="hover-scale-img radius-16 overflow-hidden border">
                            <div class="max-h-266-px position-relative overflow-hidden">
                                <a href="{{ route('kelola-galeri-foto.show', $value->id) }}">
                                    <img alt="foto-{{ $key++ }}" class="hover-scale-img__img w-100 h-100 object-fit-cover" src="{{ asset('img/' . $value->file_foto) }}">
                                </a>
                                <a class="position-absolute z-1 text-2xxl line-height-1 d-flex bg-danger-600 w-40-px h-40-px justify-content-center align-items-center rounded-circle end-0 top-0 me-8 mt-8" onclick="hapus({{ $value->id }})" style="cursor:pointer">
                                    <iconify-icon class="text-2xl text-white" icon="radix-icons:cross-2"></iconify-icon>
                                </a>
                            </div>
                            <a href="{{ route('kelola-galeri-foto.show', $value->id) }}">
                                <div class="px-24 py-16">
                                    <h6 class="mb-4">{{ Str::limit($value->nama_foto, 18) }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-24">
                {{ $GaleriFoto->links('pagination::bootstrap-5') }}
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
                        const url = "{{ route('kelola-galeri-foto.destroy', '') }}" + "/" + id;
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
                        window.location.href = "{{ route('kelola-galeri-foto.index') }}";
                    });
                }
            });
        }
    </script>
@endpush
