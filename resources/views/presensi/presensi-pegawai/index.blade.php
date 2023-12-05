@extends('template')

@push('style')
<!-- Data Tables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">


@endpush

@push('breadcrumb')
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
            <a href="{{ route('presensi-pegawai.index') }}" class="btn btn-light"><i class="fa fa-list"></i> Presensi</a>

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
                    <form method="POST" action="{{ route('presensi-pegawai.getdatapresensi') }}">
                        @csrf <!-- CSRF protection -->
                        <button class="btn btn-primary" type="submit"><i class="fa fa-refresh" aria-hidden="true"></i> Syncronize Data Presensi</button>
                    </form>

                  </div>
            </div>
        </div>

        <div class="card-body">

            <!-- /.dropdown js__dropdown -->
            <table id="tbl-data" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
						<th>tanggal presensi</th>
						<th>jam_masuk</th>
						<th>jam_pulang</th>
						<th>kekurangan_jam</th>
						<th>keterangan</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No.</th>
						<th>tanggal presensi</th>
						<th>jam_masuk</th>
						<th>jam_pulang</th>
						<th>kekurangan_jam</th>
						<th>keterangan</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-12 -->
</div>
@endsection

@push('script')
<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/table/datatable.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>

<script>
     let table;

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

        table = $('#tbl-data').DataTable({
            // DataTable configuration options
        });

        $('#btnShowData').on('click', function() {
            table.destroy();
            var dateAwal = document.getElementById('date_awal').value;
            var dateAkhir = document.getElementById('date_akhir').value;

            table = $('#tbl-data').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                responsive: true,
                pageLength: 10,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                scrollX: true,
                ajax: {
                    url: '{{ route("presensi-pegawai.datatable") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{
                        date_awal: dateAwal,
                        date_akhir: dateAkhir
                    }
                },
                columns: [
                    {
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'tanggal_presensi',
                        name: 'Tanggal Presensi',
                    },
                    {
                        data: 'jam_masuk',
                        name: 'Jam Masuk',
                    },
                    {
                        data: 'jam_pulang',
                        name: 'Jam Pulang',
                    },
                    {
                        data: 'kekurangan_jam',
                        name: 'Kekurangan Jam',
                    },
                    {
                        data: 'keterangan',
                        name: 'Keteranga',
                    }
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
        });

        $('#btnSyncData').on('click', function() {

            $.ajax({
                type: "POST",
                url: "{{ route('presensi-pegawai.getdatapresensi') }}",
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

