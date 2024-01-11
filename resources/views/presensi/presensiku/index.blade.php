@extends('template')

@push('style')
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
@endpush

@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">


@endpush

@push('breadcrumb')
        <div class="breadcrumb">
            <a href="/" class="btn btn-link"><i class="fa fa-home"></i> Home</a>
            <div class="btn">></div>
            <a href="{{ route('presensiku.index') }}" class="btn btn-link"><i class="fa fa-list"></i> Presensi</a>

        </div>
@endpush

@section('content')
    <div class="section-body">
    <div class="card">

        <div class="card-body">
            <div class="student-info">

                @php
                    $jabatan = '';
                    $unitkerja = '';
                @endphp

                @foreach ($pegawai as $data)
                    @if($data->is_plt == 1)
                        @if($jabatan == '')
                            @php
                                $jabatan = $data->nama_jabatan;
                            @endphp
                        @else
                            @php
                                $jabatan = $jabatan . ' / '. $data->nama_jabatan;
                            @endphp
                        @endif
                    @else
                        @if($jabatan == '')
                            @php
                                $jabatan = $data->nama_jabatan ;
                            @endphp
                        @else
                            @php
                                $jabatan = $jabatan .' / '. $data->nama_jabatan;
                            @endphp
                        @endif
                    @endif

                    @if($unitkerja == '')
                            @php
                                $unitkerja = $data->nama_unit_kerja;
                            @endphp
                        @else
                            @php
                                $unitkerja = $unitkerja . ' / ' . $data->nama_unit_kerja;
                            @endphp
                        @endif


                @endforeach

                @foreach ($pegawai as $data)

                    <div class="row rowdata">
                        <div class="col-sm-2">
                            <strong>NIP</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $data->nip }}
                        </div>

                        <div class="col-sm-2">
                            <strong>Pangkat</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $data->nama_pangkat }}
                        </div>
                    </div>

                    <div class="row rowdata">
                        <div class="col-sm-2">
                            <strong>Nama Pegawai</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $data->nama_depan . ' ' . $data->nama_belakang }}
                        </div>

                        <div class="col-sm-2">
                            <strong>Nama Golongan</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $data->nama_golongan }}
                        </div>
                    </div>

                    <div class="row rowdata">
                        <div class="col-sm-2">
                            <strong>Tempat & Tanggal Lahir</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d/m/Y') }}
                        </div>

                        <div class="col-sm-2">
                            <strong>Jenis Jabatan</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $data->jenis_jabatan }}
                        </div>

                    </div>

                    <div class="row rowdata">
                        <div class="col-sm-2">
                            <strong>Unit Kerja</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $unitkerja  }}
                        </div>

                        <div class="col-sm-2">
                            <strong>Nama Jabatan</strong>
                        </div>
                        <div class="col-sm-4">
                            : {{ $jabatan }}
                        </div>
                    </div>

                    @break
                @endforeach
            </div>
        </div>

        <div class="card-body">

            <div class="row rowdata">
                <div class="col-6">
                    <div class="form-group">
                        <label>Filter Dari Tanggal : </label>
                        <input type="date" class="form-control" id="date_awal" name = "date_awal" placeholder="Pilih Tanggal"/>

                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>Sampai Tanggal : </label>
                        <input type="date" class="form-control" id="date_akhir" name = "date_akhir" placeholder="Pilih Tanggal"/>

                    </div>
                  </div>

                  <div class="col-6">
                    <button class="btn btn-primary" id="btnShowData"><i class="fa fa-search" aria-hidden="true"></i> Cari Data</button>

                  </div>
                  <div class="col-6">
                        <button class="btn btn-success" id="btnGetDataPresensi"><i class="fa fa-refresh" aria-hidden="true"></i> Syncronize Data Presensi</button>
                  </div>
            </div>
        </div>


        <div class="card-body">

            <div id="exportButtonsContainer">
            </div>
            <br>
            <div id="wait-icon"><i class="fa fa-spinner fa-spin" style="font-size:30px;color:red"></i><strong style="font-size: 200%"> Mohon tunggu...</strong></div>
            <div class="table-responsive mb-4">
                <table id="tbl-data" class="table table-hover dataTable table-striped table-bordered display">
                    <thead>
                        <tr>
                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                            <th class="font-weight-bold text-dark">Tanggal Presensi</th>
                            <th class="font-weight-bold text-dark">Jam Masuk</th>
                            <th class="font-weight-bold text-dark">Jam Pulang</th>
                            <th class="font-weight-bold text-dark">Kekurangan Jam</th>
                            <th class="font-weight-bold text-dark">Nominal Potongan</th>
                            <th class="font-weight-bold text-dark">Status Kehadiran</th>
                            <th class="font-weight-bold text-dark">Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="font-weight-bold text-dark">No</th>
                            <th class="font-weight-bold text-dark">Tanggal Presensi</th>
                            <th class="font-weight-bold text-dark">Jam Masuk</th>
                            <th class="font-weight-bold text-dark">Jam Pulang</th>
                            <th class="font-weight-bold text-dark">Kekurangan Jam</th>
                            <th class="font-weight-bold text-dark">Nominal Potongan</th>
                            <th class="font-weight-bold text-dark">Status Kehadiran</th>
                            <th class="font-weight-bold text-dark">Keterangan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/table/datatable.js') }}"></script>


<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/JSZip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.bootstrap4.min.js') }}"></script>

<script src="/vendor/datatables/buttons.server-side.js"></script>

<script>
    let table;
    let btnExport = 0;
    $.noConflict();
    $(document).ready(function() {

        var currentDate = new Date();
        // Set the date to the 1st day of the current month
        currentDate.setDate(1);

        // Format the date to 'YYYY-MM-DD'
        var formattedDate = currentDate.toISOString().split('T')[0];

        document.getElementById('date_awal').value = formattedDate;

         // Get the current date
         var currentDate = new Date();

        // Format the date to 'YYYY-MM-DD'
        var formattedDate = currentDate.toISOString().split('T')[0];

        // Set the default value for the date_akhir input
        document.getElementById('date_akhir').value = formattedDate;

        // Check if DataTable is already initialized on the table
        if ($.fn.DataTable.isDataTable('#tbl-data')) {
                // DataTable is already initialized, destroy it
                $('#tbl-data').DataTable().destroy();
            }

        table = $('#tbl-data').DataTable({
            // DataTable configuration options
        });


        $('#btnGetDataPresensi').on('click', function() {
            $('#wait-icon').show();
            $.ajax({
                url: '{{ route('presensiku.getdatapresensi') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success here
                    console.log('Request successful:', response);

                    $('#wait-icon').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error here
                    console.error('Request failed:', textStatus, errorThrown);
                    $('#wait-icon').hide();
                }
            });
        });

        $('#btnShowData').on('click', function() {

            // Check if DataTable is already initialized on the table
            if ($.fn.DataTable.isDataTable('#tbl-data')) {
                // DataTable is already initialized, destroy it
                $('#tbl-data').DataTable().destroy();
            }

            var dateAwal = document.getElementById('date_awal').value;
            var dateAkhir = document.getElementById('date_akhir').value;
            btnExport = 0;
            var pegawaiDetail = @json(auth()->user()->pegawai->nama . ' NIP : ' . auth()->user()->pegawai->nip);

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
                dom: 'lBfrtip', // Include length menu (l) along with buttons (Bfrtip)
                lengthMenu: [10, 50, 100, 500, 1000, 10000,1000000],
                buttons: [
                        {extend: 'excelHtml5',
                        title: 'Data Presensi Pegawai : ' + pegawaiDetail +'  Tanggal : ' + dateAwal +' - ' + dateAkhir,
                        text:'<i class="fa fa-table fainfo" aria-hidden="true" >Test</i>',
                        titleAttr: 'Export Excel',
                        "oSelectorOpts": {filter: 'applied', order: 'current'},
                        exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7],
                                modifier: {
                                    page: 'all'
                                },
                                    format: {
                                        header: function ( data, columnIdx ) {
                                            if(columnIdx==1){
                                            return 'Tanggal Presensi';
                                            }
                                            else{
                                            return data;
                                            }
                                        }
                                    }
                            }
                }],
                ajax: {
                    url: '{{ route('presensiku.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        date_awal: dateAwal,
                        date_akhir: dateAkhir
                    },
                },
                columns: [
                    {
                        data: 'no',
                        name: 'no',
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal_presensi',
                        name: 'tanggal_presensi',
                    },
                    {
                        data: 'jam_masuk',
                        name: 'jam_masuk',
                    },
                    {
                        data: 'jam_pulang',
                        name: 'jam_pulang',
                    },
                    {
                        data: 'kekurangan_jam',
                        name: 'kekurangan_jam',
                    },
                    {
                        data: 'nominal_potongan',
                        name: 'nominal_potongan',
                    },
                    {
                        data: 'status_kehadiran',
                        name: 'status_kehadiran',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                ],
                columnDefs: [{
                    'sortable': false,
                    'searchable': false,
                    'targets': [0, -1]
                }],
                order: [
                    [1, 'asc']
                ],
                language: {
                    processing: "<span class='fa fa-spinner fa-spin fa-spin' style='font-size:30px;color:red'></span><strong style='font-size: 140%'> Mohon Tunggu..</strong>"
                },
                drawCallback: function(settings) {
                    if (btnExport == 1) {
                        btnExport = 0;
                        $('.buttons-excel').click();
                        table.page.len(10).draw();
                    }

                }
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

            // Add row numbers to the DataTable
            table.on('order.dt search.dt', function() {
                table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

             new $.fn.dataTable.Buttons(table, {
                buttons: [{
                    text: '<i class="fa fa-file-excel-o btn-success"></i> Ekspor Data',
                    action: function () {
                        btnExport = 1;
                        table.page.len(1000000).draw();
                    }
                }]
            });

            // Add the custom button to the DataTable
            $('#exportButtonsContainer').append(table.buttons(1, null).container());


        });

        $('#btnSyncData').on('click', function() {

            $.ajax({
                type: "POST",
                url: "{{ route('presensiku.getdatapresensi') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                cache: false,
                success: function(response) {
                },
                error: function(data) {
                    console.log('error : ', data);
                }
            });

        });

        $("#btnShowData").click();

    });
</script>

<script type="text/javascript">
    "use strict"

    $(function() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "rtl": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if(session('success'))
            toastr['success']('{{ session("success") }}');
        @endif


    });


</script>
@endpush

