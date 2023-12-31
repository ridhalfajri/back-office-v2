@extends('template')

@push('style')
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

    {{-- custom css datatable --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/custom.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" />
@endpush

@push('breadcrumb')
    <ol class="breadcrumb custom-background-color">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
        <!-- <li class="breadcrumb-item"><a href="#">Gaji</a></li>        -->
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    {{-- card-header --}}
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        @if (session('message'))
                            <div class="alert alert-warning">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <label class="form-label"><i>Filter Datatable</i></label>
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('tahun')has-error @enderror">
                                    <label class="form-label">Tahun</label>
                                    <select id="tahun" name="tahun" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @for ($a = Carbon\Carbon::now()->format('Y'); $a >= Carbon\Carbon::now()->format('Y') - 4; $a--)
                                            <option value="{{ $a }}">{{ $a }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="box-title" style="text-align: center;"><b>List Riwayat THR</b></h5>

                        <table id="tbl-data" class="table table-hover js-basic-example dataTable table_custom spacing5">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Gaji Pokok</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Beras</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Pasangan</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Anak</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Jabatan</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Kinerja</th>
                                    <th class="font-weight-bold text-dark">Total THR</th>
                                    <th class="font-weight-bold text-dark">Periode</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Gaji Pokok</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Beras</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Pasangan</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Anak</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Jabatan</th>
                                    <th class="font-weight-bold text-dark">Tunjangan<br>Kinerja</th>
                                    <th class="font-weight-bold text-dark">Total THR</th>
                                    <th class="font-weight-bold text-dark">Periode</th>
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
    <!-- Data Tables -->

    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        "use strict"
        let table;

        $('#tahun').select2({
            width: 'resolve'
        });

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
                    url: '{{ route('riwayat-thr.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function(d) {
                        //untuk on change datatable
                        d.tahun = $('#tahun').val();
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'nominal_gaji_pokok',
                        name: 'pegawai_riwayat_thr.nominal_gaji_pokok',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'tunjangan_beras',
                        name: 'pegawai_riwayat_thr.tunjangan_beras',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'tunjangan_pasangan',
                        name: 'pegawai_riwayat_thr.tunjangan_pasangan',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'tunjangan_anak',
                        name: 'pegawai_riwayat_thr.tunjangan_anak',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'tunjangan_jabatan',
                        name: 'pegawai_riwayat_thr.tunjangan_jabatan',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'tunjangan_kinerja',
                        name: 'pegawai_riwayat_thr.tunjangan_kinerja',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'total_thr',
                        name: 'pegawai_riwayat_thr.total_thr',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'tahun',
                        name: 'pegawai_riwayat_thr.tahun',
                        class: 'text-center'
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

            //untuk on change datatable
            $('#tahun').change(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });
        });
    </script>
@endpush
