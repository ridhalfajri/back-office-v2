@extends('template')
@push('style')
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="section-body  py-4">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <a href="{{ route('cuti.pengajuan-cuti') }}" class="btn btn-primary my-3">Tambah</a>
                            <div class="table-responsive mb-4">
                                <table id="tbl-riwayat-cuti"
                                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Pengajuan</th>
                                            <th class="font-weight-bold text-dark">Jenis Cuti</th>
                                            <th class="font-weight-bold text-dark">Tanggal Awal</th>
                                            <th class="font-weight-bold text-dark">Tanggal Akhir</th>
                                            <th class="font-weight-bold text-dark">Status</th>
                                            <th class="font-weight-bold text-dark">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Pengajuan</th>
                                            <th class="font-weight-bold text-dark">Jenis Cuti</th>
                                            <th class="font-weight-bold text-dark">Tanggal Awal</th>
                                            <th class="font-weight-bold text-dark">Tanggal Akhir</th>
                                            <th class="font-weight-bold text-dark">Status</th>
                                            <th class="font-weight-bold text-dark">Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
        let table;

        $(function() {
            table = $('#tbl-riwayat-cuti').DataTable({
                processing: true,
                destroy: true,
                serverSide: true,
                deferRender: true,
                responsive: true,
                pageLength: 10,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('cuti.datatable-riwayat-cuti') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'tanggal_pengajuan',
                        name: 'pegawai_cuti.created_at',
                    },
                    {
                        data: 'jenis',
                        name: 'jenis_cuti.jenis',
                    },
                    {
                        data: 'tanggal_awal_cuti',
                        name: 'tanggal_awal_cuti',
                    },
                    {
                        data: 'tanggal_akhir_cuti',
                        name: 'tanggal_akhir_cuti',
                    },
                    {
                        data: 'status',
                        name: 'status_cuti.status',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        class: 'text-center actions'
                    },
                ],
                columnDefs: [{
                    'sortable': false,
                    'searchable': false,
                    'targets': [0, -1]
                }],
                order: [
                    [1, 'asc']
                ]
            });

            table.on('draw.dt', function() {
                var info = table.page.info();
                table.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });
        })
    </script>
    <script>
        const delete_cuti = (id) => {
            Swal.fire({
                title: "Apakah anda yakin hapus pendidikan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                confirmButtonColor: "#DC3444",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/cuti/pengajuan_cuti/" + id,
                        type: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": '{{ csrf_token() }}',
                        },
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.errors) {
                                if (response.errors) {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.errors.connection,
                                        icon: "error",
                                        confirmButtonText: "Tutup",
                                    });
                                }
                            } else if (response.success) {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.success,
                                    icon: "success",
                                    confirmButtonText: "Tutup",
                                });
                                $("#tbl-riwayat-cuti").DataTable().ajax.reload();
                            }
                        },
                    });
                }
            });
        };
    </script>
@endpush
