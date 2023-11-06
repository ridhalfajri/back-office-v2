@extends('layout')
@push('style')
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

        {{-- custom css datatable --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/custom.css') }}">

@endpush

@push('breadcrumb')
        <ol class="breadcrumb custom-background-color">
            <li class="breadcrumb-item"><a href="{{ route('jabatan-tukin.index') }}"><i class="fa fa-home"></i></a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Gaji</a></li>        -->
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
@endpush

@section('content')

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <button type="button" class="btn btn-xs btn-primary" id="btn-add" onclick="window.location.href = '{{ route("gaji.create") }}';"><i class="fa fa-plus"></i> Tambah</button>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="tbl-data"
                            class="table table-hover js-basic-example dataTable table_custom spacing5">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>No Telepon</th>
                                    <th>Email Kantor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>No Telepon</th>
                                    <th>Email Kantor</th>
                                    <th>Aksi</th>
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

@endsection


@push('script')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
        let table;

        $(function() {
            table = $('#tbl-data').DataTable({
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
                    url: '{{ route('jabatan-tukin.datatable') }}',
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
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'nip',
                        name: 'nip',
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp',
                    },
                    {
                        data: 'email_kantor',
                        name: 'email_kantor',
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
    @if (session()->has('error'))
        <script>
            const msg = <?php echo json_encode(Session::get('error')); ?>;
            $(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: msg,
                })
                return false;
            })
        </script>
    @endif
@endpush

