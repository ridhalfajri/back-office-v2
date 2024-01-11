@extends('template')

@push('style')
<!-- Data Tables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cust_dt.css') }}">
@endpush

@push('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('pre-tubel.index') }}">Riwayat Tugas Belajar</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
</nav>
@endpush

@section('content')
    <div class="section-body">
    <div class="card">
        <div class="card-body">
            <div id="exportButtonsContainer">
            </div>
            <br>

            <table id="tbl-data" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
						<th>nip</th>
						<th>nama</th>
						<th>tanggal mulai</th>
                        <th>tanggal berakhir</th>
                        <th>nama jabatan</th>
                        <th>nama unit kerja</th>
                        <th>Status Aktif</th>
                        <th style="width: 40px">aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No.</th>
						<th>nip</th>
						<th>nama</th>
						<th>tanggal mulai</th>
                        <th>tanggal berakhir</th>
                        <th>nama jabatan</th>
                        <th>nama unit kerja</th>
                        <th>Status Aktif</th>
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
                    title: 'Data Tugas Belajar Pegawai',
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
                url: '{{ route("pre-tubel.datatable") }}',
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
                    data: 'nip',
                    name: 'p.nip'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
				{
                    data: 'tanggal_awal',
                    name: 's.tanggal_awal',
                    class: 'text-center'
                },
				{
                    data: 'tanggal_akhir',
                    name: 's.tanggal_akhir',
                    class: 'text-center'
                },
                {
                    data: 'nama_jabatan',
                    name: 'z.nama_jabatan'
                },
                {
                    data: 'nama_unit_kerja',
                    name: 'y.nama_unit_kerja'
                },
                {
                    data: 'is_active',
                    name: 's.is_active',
                    class: 'text-center'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
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
                            toastr['error']('Data Pre Tubel gagal di hapus!');
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
            $.ajax({
                url: "{{ url('pre-tubel') }}/" + id,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                data: {
                    _method: 'DELETE'
                }
            }).done(function(hasil) {
                resolve(hasil);
            }).fail(function() {
                reject('Gagal menghapus data Pre Tubel!');
            })
        })
    }
</script>
@endpush

