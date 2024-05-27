@extends('template')

@push('style')
<!-- Data Tables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cust_dt.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Dinas Luar</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="bg-primary">
                <div class="btn-group btn-breadcrumb">
                    <a href="{{ route('pre-dinas-luar.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Riwayat Dinas Luar</a>

                    <a href="/presensi/pre-dinas-luar/create" class="btn btn-success"><i class="fa fa-plus"></i> Pengajuan Dinas Luar</a>
                    @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
                        auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                         <a href="/presensi/pre-dinas-luar/persetujuan" class="btn btn-info"><i class="fa fa-check"></i> Persetujuan Dinas Luar</a>
                    @endif

                </div>
            </div>
        </div>
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

            <h5><strong>Riwayat Dinas Luar<strong></h5>
            <br>
            <div id="exportButtonsContainer">
            </div>
            <br>
            <!-- /.dropdown js__dropdown -->
            <table id="tbl-data" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
						<th colspan="2" class="text-center">Tanggal Dinas</th>
						<th rowspan="2">jenis dinas</th>
                        <th rowspan="2">nama kegiatan</th>
						<th rowspan="2">lokasi</th>
                        <th rowspan="2">Surat Tugas</th>
                        <th rowspan="2">Referensi</th>
                        <th rowspan="2">status approval</th>
						<th rowspan="2">status aktif</th>
                        <th rowspan="2" style="width: 40px">aksi</th>
                    </tr>
                    <tr>
                        <th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                    </tr>

                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th>jenis dinas</th>
                        <th>nama kegiatan</th>
                        <th>lokasi</th>
                        <th>Surat Tugas</th>
                        <th>Referensi</th>
						<th>status approval</th>
                        <th>status aktif</th>
                        <th style="width: 40px">aksi</th>
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
<script src="{{ asset('assets/plugins/select2-4.0.13/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/table/datatable.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/JSZip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/buttons/buttons.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
    "use strict"
    let table;
    let btnExport = 0;
    $.noConflict();
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
                    title: 'Data Dinas Luar',
                    text:'<i class="fa fa-table fainfo" aria-hidden="true" >Test</i>',
                    titleAttr: 'Export Excel',
                    "oSelectorOpts": {filter: 'applied', order: 'current'},
                    exportOptions: {
                            columns: [ 1, 2, 3, 4, 5, 6],
                            modifier: {
                            page: 'all'
                            },
                                format: {
                                    header: function ( data, columnIdx ) {
                                        return data;
                                    }
                                }
                        }
            }],
            lengthMenu: [10, 50, 100, 500, 1000, 10000,1000000],
            ajax: {
                url: '{{ route("pre-dinas-luar.datatable") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    data: 'no',
                    name: 'no',
                    class: 'text-center align-middle'
                },
				{
                    data: 'tanggal_dinas_awal',
                    name: 'tanggal_dinas_awal'
                },
                {
                    data: 'tanggal_dinas_akhir',
                    name: 'tanggal_dinas_akhir'
                },
                {
                    data: 'jenis_dinas',
                    name: 'jenis_dinas',
                    class: 'align-middle'
                },
                {
                    data: 'nama_kegiatan',
                    name: 'nama_kegiatan',
                    class: 'align-middle'
                },
                {
                    data: 'lokasi',
                    name: 'lokasi',
                    class: 'align-middle'
                },
                {
                    data: 'file_st',
                    name: 'file_st',
                    render: function(data, type, row) {
                        if (data){
                            var url = new URL(data);
                            // Extract the pathname and split it to get the filename
                            var filename = url.pathname.split('/').pop();

                            return '<a href="'+data+'" target="_blank">'+filename+'</a>';
                        }
                        else
                        {
                            return '';
                        }
                    },
                    class: 'align-middle',
                },
                {
                    data: 'file_ref',
                    name: 'file_ref',
                    render: function(data, type, row) {
                        if (data){
                            var urlRef = new URL(data);
                            // Extract the pathname and split it to get the filename
                            var filenameRef = urlRef.pathname.split('/').pop();
                            return '<a href="'+data+'" target="_blank">'+filenameRef+'</a>';
                        }else
                        {
                            return '';
                        }
                    },
                    class: 'align-middle',
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'text-center align-middle',
                    render: function(data, type, row) {
                        switch (data) {
                            case "Pengajuan":
                                return '<span class="badge badge-pill badge-warning">' + data +
                                    '</span>';
                                break;
                            case "Disetujui":
                                return '<span class="badge badge-pill badge-primary">' + data +
                                    '</span>';
                                break;
                            case "Ditolak":
                                return '<span class="badge badge-pill badge-danger">' + data +
                                    '</span>';
                                break;
                        }
                    }
                },
                {
                    data: 'is_active',
                    name: 'is_active',
                    class: 'text-center align-middle',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    class: 'text-center align-middle',
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


        $('#tbl-data').delegate('button.delete', 'click', function(e) {
            e.preventDefault();

            var that = $(this);

            swal({
                title: 'Konfirmasi!',
                text: 'Apakah anda yakin ingin menghapus data ini?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    delete_data(that.data('id')).then(function(hasil) {
                        if (hasil.status.error == true) {
                            toastr['error']('Data Pre Ijin gagal di hapus!');
                        } else {
                            table.ajax.reload();
                            toastr['success'](hasil.status.message);
                        }
                    }).catch(function(err) {
                        console.log(err);
                    })

                } else {
                    swal('Informasi', 'Hapus data dibatalkan', 'error');
                }
            })
        });
    });

    function delete_data(id) {
        return new Promise(function(resolve, reject) {
            console.log(id);
            $.ajax({
                url: "{{ url('presensi/pre-dinas-luar') }}/" + id,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                data: {
                    _method: 'DELETE'
                }
            }).done(function(hasil) {
                console.log('berhasil');
                resolve(hasil);
            }).fail(function() {
                reject('Gagal menghapus data Pre Ijin!');
            })
        })
    }
</script>
@endpush

