@extends('layouts.admin.preset')
@section('judul', 'Kelola PPDB')
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
                <h6 class="fw-semibold mb-0">Kelola PPDB</h6>
            </div>
        </div>
        <div class="card-body p-24">
            <div class="table-responsive">
                <table class="bordered-table nowrap w-100 mb-0 table" data-page-length='10' id="dataTable">
                    <thead>
                        <tr>
                            <th class="w-100-px text-center" scope="col">No.</th>
                            <th scope="col">No. Pendaftaran</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Status Diterima</th>
                            <th class="w-200-px text-center" scope="col"></th>
                            <th class="w-200-px text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
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
                    targets: [0, 5, 6]
                }, ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'id_pendaftaran',
                        name: 'id_pendaftaran'
                    }, {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'nisn',
                        name: 'nisn'
                    }, {
                        data: 'detail_siswa',
                        name: 'detail_siswa.status_siswa',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status_terima',
                        name: 'status_terima',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                drawCallback: function() {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });
        });

        function terima(id) {
            Swal2.fire({
                title: "Terima Siswa?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya",
                cancelButtonText: "Batal",
                showLoaderOnConfirm: true,
                reverseButtons: true,
                preConfirm: () => {
                    let token = $("meta[name='csrf-token']").attr("content");
                    return $.ajax({
                        url: window.location.href + '/terima/' + id,
                        type: "POST",
                        data: {
                            '_method': 'PUT',
                            "_token": token
                        },
                    }).then(response => {
                        return response;
                    }).catch(error => {
                        Swal.showValidationMessage("Terjadi kesalahan saat memproses data");
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal2.fire({
                        title: "Diterima!",
                        icon: "success",
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    </script>
@endpush
