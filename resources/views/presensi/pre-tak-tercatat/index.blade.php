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
        <div class="breadcrumb">
            <a href="/" class="btn btn-link"><i class="fa fa-home"></i> Home</a>
            <div class="btn">></div>
            <a href="{{ route('pre-ijin.index') }}" class="btn btn-link"><i class="fa fa-list"></i> Presensi Tidak Tercatat</a>
        </div>
@endpush

@section('content')
    <div class="section-body">
    <div class="card">
        <div class="card-body">
            <div class="bg-primary">
                <div class="btn-group btn-breadcrumb">
                    <a href="{{ route('pre-tak-tercatat.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Riwayat Presensi Tidak Tercatat</a>

                    <a href="/presensi/pre-tak-tercatat/create" class="btn btn-success"><i class="fa fa-plus"></i> Pengajuan Presensi Tidak Tercatat</a>
                    @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
                        auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                         <a href="/presensi/pre-tak-tercatat/persetujuan" class="btn btn-info"><i class="fa fa-check"></i> Persetujuan Presensi Tidak Tercatat</a>
                    @endif

                </div>
            </div>
        </div>

        @include('presensi.detail')

        <div class="card-body">

            <h5><strong>Riwayat Presensi Tidak Tercatat<strong></h5>
            <br>
            <div id="exportButtonsContainer">
            </div>
            <br>
            <!-- /.dropdown js__dropdown -->
            <table id="tbl-data" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
						<th>tanggal pengajuan</th>
                        <th>jam</th>
                        <th>Presensi</th>
						<th>status</th>
                         <th style="width: 40px">aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No.</th>
						<th>tanggal pengajuan</th>
                        <th>jam</th>
                        <th>Presensi</th>
						<th>status</th>
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

    });

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

        @if(session('warning'))
            toastr['warning']('{{ session("warning") }}');
        @endif
        btnExport = 0;
        var pegawaiDetail = @json(auth()->user()->pegawai->nama . ' NIP : ' . auth()->user()->pegawai->nip);

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
            dom: 'lBfrtip', // Include length menu (l) along with buttons (Bfrtip)
            buttons: [
                    {extend: 'excelHtml5',
                    title: 'Data Presensi Tidak Tercatat Pegawai : ' + pegawaiDetail,
                    text:'<i class="fa fa-table fainfo" aria-hidden="true" >Test</i>',
                    titleAttr: 'Export Excel',
                    "oSelectorOpts": {filter: 'applied', order: 'current'},
                    exportOptions: {
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
                url: '{{ route("pre-tak-tercatat.datatable") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    data: 'no',
                    name: 'no',
                    class: 'text-center'
                },
				{
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan'
                },
                {
                    data: 'jam_perubahan',
                    name: 'jam_perubahan'
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },
                {
                    data: 'status',
                    name: 'status',
                     class: 'text-center',
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
                    data: 'aksi',
                    name: 'aksi',
                    class: 'text-center'
                },
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
            },
            columnDefs: [{
                'sortable': false,
                'searchable': false,
                'targets': [0, -1]
            }],
            order: [
                [1, 'asc']
            ]
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
                url: "{{ url('presensi/pre-ijin') }}/" + id,
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

