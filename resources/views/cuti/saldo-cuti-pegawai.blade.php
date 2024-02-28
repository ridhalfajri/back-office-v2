@extends('template')
@push('style')
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
@endpush
@push('breadcrumb')
    <ol class="breadcrumb custom-background-color">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="section-body  py-4">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-md-12 col-lg-12">
                            @if($tahun_cuti)
                            <button type="button" id="btn-update-saldo" name="btn-update-saldo"
                                class="btn btn-primary mb-2">Update Saldo</button>
                            @endif
                        </div>
                        <div class="col-lg-12">

                            <div class="table-responsive mb-4">
                                <table id="tbl-saldo-cuti"
                                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Nama</th>
                                            <th class="font-weight-bold text-dark">Saldo N</th>
                                            <th class="font-weight-bold text-dark">Saldo N-1</th>
                                            <th class="font-weight-bold text-dark">Saldo N-2</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Nama</th>
                                            <th class="font-weight-bold text-dark">Saldo N</th>
                                            <th class="font-weight-bold text-dark">Saldo N-1</th>
                                            <th class="font-weight-bold text-dark">Saldo N-2</th>
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
@push('modal')
@endpush
@push('script')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
        let table;
        $(function() {
            saldo_cuti();
        })
        const saldo_cuti = () => {
            table = $('#tbl-saldo-cuti').DataTable({
                processing: true,
                destroy: true,
                serverSide: true,
                deferRender: true,
                responsive: true,
                pageLength: 10,
                paging: true,
                searching: true,
                ordering: true,
                searchDelay: 1000,
                info: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('cuti.datatable-saldo-cuti-pegawai') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        unit_kerja: $('#unit_kerja').val(),
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                    },
                    {
                        data: 'saldo_n',
                        name: 'pegawai_cuti.saldo_n',
                    },
                    {
                        data: 'saldo_n_1',
                        name: 'pegawai_cuti.saldo_n_1',
                    },
                    {
                        data: 'saldo_n_2',
                        name: 'pegawai_cuti.saldo_n_2',
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
        }

        $('#btn-update-saldo').on('click', () => {
            Swal.fire({
                title: "Apakah anda ingin update saldo cuti?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Update",
                confirmButtonColor: "#056ADA",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('cuti.update-all-saldo-cuti') }}',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.errors) {
                                if (response.errors.data) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.errors.data,
                                        icon: 'error',
                                        confirmButtonText: 'Tutup'
                                    })
                                }
                                if (response.errors.connection) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.errors.connection,
                                        icon: 'error',
                                        confirmButtonText: 'Tutup'
                                    })
                                }
                            } else {
                                Swal.fire({
                                    title: 'Tersimpan!',
                                    text: response.success,
                                    icon: 'success',
                                    confirmButtonText: 'Tutup'
                                })
                            }
                            saldo_cuti();

                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        })
    </script>
@endpush
