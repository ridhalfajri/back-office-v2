@extends('template')

@push('style')
<!-- Data Tables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cust_dt.css') }}">
<style>
    .table tr th {
        text-align: center;
        vertical-align: middle;
    }
</style>
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Pengaturan Jam Kerja</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <button type="button" class="btn btn-xs btn-primary" id="btn-add" onclick="window.location.href='{{ route("pre-jam-kerja.create") }}'">
                    <i class="fa fa-plus"> Jam Kerja Baru</i>
                </button>
            </h4>
        </div>

        <div class="card-body">
            <!-- /.dropdown js__dropdown -->
            <table id="tbl-data" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
						<th colspan="2" class="text-center">Hari Senin-Kamis</th>
						<th colspan="2" class="text-center">Hari Jum'at</th>
						<th rowspan="2">waktu_floating</th>
						<th rowspan="2">is_active</th>
						<th rowspan="2">keterangan</th>
                         <th rowspan="2" style="width: 40px">aksi</th>
                    </tr>
                    <tr>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No.</th>
						<th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
						<th>waktu_floating</th>
						<th>is_active</th>
						<th>keterangan</th>
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

<script type="text/javascript">
    "use strict"

    let table;

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
            ajax: {
                url: '{{ route("pre-jam-kerja.datatable") }}',
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
                    data: 'jam_masuk',
                    name: 'Jam Masuk',
                    class: 'text-center'
                },
				{
                    data: 'jam_pulang',
                    name: 'Jam Pulang',
                    class: 'text-center'
                },
				{
                    data: 'jam_masuk_khusus',
                    name: 'Jam Masuk Khusus',
                    class: 'text-center'
                },
				{
                    data: 'jam_pulang_khusus',
                    name: 'Jam Pulang Khusus',
                    class: 'text-center'
                },
				{
                    data: 'waktu_floating',
                    name: 'Waktu Floating',
                    class: 'text-center'
                },
				{
                    data: 'is_active',
                    name: 'Is Active',
                    class: 'text-center'
                },
				{
                    data: 'keterangan',
                    name: 'Keterangan',

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
                            toastr['error']('Data Pre Jam Kerja gagal di hapus!');
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
                url: "{{ url('presensi/pre-jam-kerja') }}/" + id,
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
                reject('Gagal menghapus data Pre Jam Kerja!');
            })
        })
    }
</script>
@endpush

