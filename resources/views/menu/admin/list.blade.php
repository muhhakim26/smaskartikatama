@extends('layouts.preset')
@section('judul', 'Kelola Admin')
@push('style')
    <!-- style untuk kolom serach -->
    <style>
        div.dt-container .dt-search input {
            text-align: left
        }
    </style>
@endpush
@section('konten')
    <div class="card h-100 radius-12 basic-data-table p-0">
        <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between flex-wrap gap-3 px-24 py-16">
            <div class="d-flex align-items-center flex-wrap gap-3">
                <h6 class="fw-semibold mb-0">Kelola Admin</h6>
            </div>
            <a class="btn btn-primary btn-sm radius-8 d-flex align-items-center gap-2 px-12 py-12 text-sm" href="{{ route('kelola-admin.create') }}">
                <iconify-icon class="icon line-height-1 text-xl" icon="ic:baseline-plus"></iconify-icon>
                Buat
            </a>
        </div>
        <div class="card-body p-24">
            <table class="bordered-table nowrap w-100 mb-0 table" data-page-length='10' id="dataTable">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th class="text-center" scope="col">Level</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    @if (session()->has('message'))
        <script>
            Swal2.fire({
                icon: "success",
                title: "{{ session()->get('message') }}",
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            let table = new DataTable("#dataTable", {
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: window.location.href,
                order: [],
                columnDefs: [{
                    className: "text-center",
                    targets: [0, 3, 4]
                }, ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'level',
                        name: 'level',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });

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
