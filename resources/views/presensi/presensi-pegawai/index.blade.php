@extends('template')

@push('style')
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
    <style>
        .select2-drop li {
           white-space: pre;
        }

        .hidden {
            display: none !important;
        }

    </style>


@endpush



@push('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('presensi-pegawai') }}">Presensi Pegawai</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
</nav>
@endpush

@section('content')
    <div class="section-body">
    <div class="card">

        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Filter Dari Tanggal : </label>
                        <input type="date" class="form-control" id="date_awal" name = "date_awal" placeholder="Pilih Tanggal"/>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Sampai Tanggal : </label>
                        <input type="date" class="form-control" id="date_akhir" name = "date_akhir" placeholder="Pilih Tanggal"/>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Nama Pegawai : </label>
                        <select class="form-control col-md-12" id="pegawai_id" name="pegawai_id" required>
                            <option value="" selected>Semua</option>
                            @foreach ($pegawai as $data)
                                <option value="{{ $data->id }}" {{ old('pegawai_id') == $data->id ? 'selected' : '' }}>
                                    NIP  : {{ $data->nip }} [br] Nama : {{ $data->nama_depan . ' ' . $data->nama_belakang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Unit Kerja : </label>
                        <select class="form-control col-md-12" id="hirarki_unit_kerja_id" name="hirarki_unit_kerja_id" required>
                            @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                                <option value="" selected>Semua</option>
                           @endif

                           @foreach ($hirarkiUnitKerja as $index => $data)
                           {{-- <option value="{{ $data->id }}" {{ ($index === 0 && !old('hirarki_unit_kerja_id')) || old('hirarki_unit_kerja_id') == $data->id ? 'selected' : '' }}> --}}
                               <option value="{{ $data->id }}" {{ old('hirarki_unit_kerja_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama_unit_kerja}}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
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
                            <th style="width: 5%" class="font-weight-bold text-dark align-middle">No</th>
                            <th class="font-weight-bold text-dark align-middle">NIP</th>
                            <th class="font-weight-bold text-dark align-middle">Nama Pegawai</th>
                            <th class="font-weight-bold text-dark align-middle">Jabatan</th>
                            <th class="font-weight-bold text-dark align-middle">Unit Kerja</th>
                            <th class="font-weight-bold text-dark align-middle">Tanggal Presensi</th>
                            <th class="font-weight-bold text-dark align-middle">Jam Masuk</th>
                            <th class="font-weight-bold text-dark align-middle">Jam Pulang</th>
                            <th class="font-weight-bold text-dark align-middle">Kekurangan Jam Kerja</th>
                            <th class="font-weight-bold text-dark align-middle">Kelebihan Jam Kerja</th>
                            <th class="font-weight-bold text-dark align-middle">Nominal Potongan</th>
                            <th class="font-weight-bold text-dark align-middle">Status Kehadiran</th>
                            <th class="font-weight-bold text-dark align-middle">Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="font-weight-bold text-dark align-middle">No</th>
                            <th class="font-weight-bold text-dark align-middle">NIP</th>
                            <th class="font-weight-bold text-dark align-middle">Nama Pegawai</th>
                            <th class="font-weight-bold text-dark align-middle">Jabatan</th>
                            <th class="font-weight-bold text-dark align-middle">Unit Kerja</th>
                            <th class="font-weight-bold text-dark align-middle">Tanggal Presensi</th>
                            <th class="font-weight-bold text-dark align-middle">Jam Masuk</th>
                            <th class="font-weight-bold text-dark align-middle">Jam Pulang</th>
                            <th class="font-weight-bold text-dark align-middle">Kekurangan Jam Kerja Normal</th>
                            <th class="font-weight-bold text-dark align-middle">Kelebihan Jam Kerja</th>
                            <th class="font-weight-bold text-dark align-middle">Nominal Potongan</th>
                            <th class="font-weight-bold text-dark align-middle">Status Kehadiran</th>
                            <th class="font-weight-bold text-dark align-middle">Keterangan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <br>

            <div id="scrollButtonsContainer">
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
<script src="{{ asset('assets/plugins/select2-4.0.13/dist/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/JSZip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

{{-- <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}
<script>
    let table;
    let btnExport = 0;
    $.noConflict();
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
        // if ($.fn.DataTable.isDataTable('#tbl-data')) {
        //         // DataTable is already initialized, destroy it
        //         $('#tbl-data').DataTable().destroy();
        //     }

        // table = $('#tbl-data').DataTable({
        //     // DataTable configuration options
        // });


        $('#hirarki_unit_kerja_id').select2({
            width: '100%',
        });

        function templateResult(item, container) {
            // replace the placeholder with the break-tag and put it into an jquery object
            return $('<span>' + item.text.replace('[br]', '<br/>') + '</span>');
        }

        function templateSelection(item, container) {
            // replace your placeholder with nothing, so your select shows the whole option text
            return item.text.replace('[br]', '');
        }

        $('#pegawai_id').select2({
            templateResult: templateResult,
            templateSelection: templateSelection,
            width: '100%',
        });

        $('#btnShowData').on('click', function() {
            // Check if DataTable is already initialized on the table
            // if ($.fn.DataTable.isDataTable('#tbl-data')) {
            //     // DataTable is already initialized, destroy it
            //     $('#tbl-data').DataTable().destroy();
            // }

            var dateAwal = document.getElementById('date_awal').value;
            var dateAkhir = document.getElementById('date_akhir').value;
            var selectedPegawaiId = document.getElementById('pegawai_id').value;
            var selectedHirarkiUnitKerjaId = document.getElementById('hirarki_unit_kerja_id').value;
            console.log('OK sudah');

            btnExport = 0;
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
                buttons: [
                        {extend: 'excelHtml5',
                        title: 'Data Presensi Tanggal : ' + dateAwal +' - ' + dateAkhir,
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
                lengthMenu: [10, 50, 100, 500, 1000, 10000,1000000],
                ajax: {
                    url: '{{ route("presensi-pegawai.datatablepresensi") }}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        date_awal: dateAwal,
                        date_akhir: dateAkhir,
                        pegawai_id: selectedPegawaiId,
                        hirarki_unit_kerja_id: selectedHirarkiUnitKerjaId,
                    },
                },
                columns: [
                    {
                        data: 'no',
                        name: 'no',
                        className: 'text-center',
                    },
                    {
                        data: 'nip',
                        name: 'nip',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                    },
                    {
                        data: 'nama_jabatan',
                        name: 'z.nama_jabatan',
                    },
                    {
                        data: 'nama_unit_kerja',
                        name: 'y.nama_unit_kerja',
                    },
                    {
                        data: 'tanggal_presensi',
                        name: 'o.tanggal_presensi',
                    },
                    {
                        data: 'jam_masuk',
                        name: 'o.jam_masuk',
                    },
                    {
                        data: 'jam_pulang',
                        name: 'o.jam_pulang',
                    },
                    {
                        data: 'kekurangan_jam',
                        name: 'o.kekurangan_jam',
                        className: 'text-center',
                        render: function(data, type, row) {
                            switch (data) {
                                case null:
                                    return '';
                                    break;
                                case "00:00:00":
                                    return '<strong>' + data + '</strong>';
                                    break;
                                default:
                                    return '<span class="badge badge-pill badge-danger">' + '<strong">' + data + '</strong>' +
                                        '</span>';
                            }
                        }
                    },
                    {
                        data: 'kelebihan_jam',
                        name: 'o.kelebihan_jam',
                        className: 'text-center',
                        render: function(data, type, row) {
                            switch (data) {
                                case null:
                                    return '';
                                    break;
                                case "00:00:00":
                                    return '<strong>' + data + '</strong>';
                                    break;
                                default:
                                    return '<span class="badge badge-pill badge-success">' + '<strong>' + data + '</strong>' +
                                        '</span>';
                            }
                        }
                    },
                    {
                        data: 'nominal_potongan',
                        name: 'o.nominal_potongan',
                    },
                    {
                        data: 'status_kehadiran',
                        name: 'o.status_kehadiran',
                    },
                    {
                        data: 'keterangan',
                        name: 'o.keterangan',
                        className: 'text-left',
                        render: function(data, type, row) {
                            return '<p class="font-weight-bold text-dark">' + data + '</p>';
                        }
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
                    // Check if the current page length is -1
                    if (btnExport == 1) {
                        btnExport = 0;
                        $('.buttons-excel').click();
                        table.page.len(10).draw();
                    }
                }
            });

            // // Add row numbers to the DataTable
            // table.on('order.dt search.dt', function() {
            //     table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // }).draw();

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

             // Add a custom button to export all data
             new $.fn.dataTable.Buttons(table, {
                buttons: [{
                    text: '<i class="fa fa-file-excel-o btn-success"></i> Ekspor Data',
                    action: function () {
                        btnExport = 1;
                        table.page.len(1000000).draw();
                    }
                }]
            });


            $('#exportButtonsContainer').append(table.buttons(1, null).container());

            new $.fn.dataTable.Buttons(table, {
                buttons: [{
                    text: 'Scroll to Top',
                    action: function () {
                        // Scroll to the top of the page
                        $('html, body').animate({scrollTop: 0}, 'fast');
                    }
                }]
            }).container().appendTo(table.table().container());


            $('#scrollButtonsContainer').append(table.buttons(2, null).container());


        });


        $('#btnGetDataPresensi').on('click', function() {
            $('#wait-icon').show();
            $.ajax({
                url: "{{ route('presensi-pegawai.getdatapresensipegawai') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success here
                    if(response.status){
                        console.log(response.message);
                        toastr['success'](response.message);
                        $("#btnShowData").click();
                    }else{
                        console.log(response.message);
                        toastr['warning'](response.message);
                    }


                    $('#wait-icon').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error here
                    console.error('Request failed:', textStatus, errorThrown);
                    $('#wait-icon').hide();
                }
            });
        });


        setTimeout(myFunction, 1000);

    });

    function myFunction()
    {
        var myButton = document.getElementById('btnShowData');
        if (myButton) {
            console.log('button OK');
            myButton.click();
        }
    }


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

