@extends('template')

@push('style')
<!-- Data Tables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
@endpush

@push('breadcrumb')
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
            <a href="{{ route('jabatan-tukin.index') }}" class="btn btn-light"><i class="fa fa-list"></i> Tunjangan Kinerja Jabatan</a>
            <a href="/jabatan-tukin/create" class="btn btn-light"><i class="fa fa-plus"></i> Tunjangan Kinerja Baru</a>
            {{-- <a href="/" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
        </div>
@endpush

@section('content')
    <div class="section-body">
    <div class="card">
        <div class="card-body">
            <!-- /.dropdown js__dropdown -->
            <table id="tbl-data" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
						<th>Jenis Jabatan</th>
						<th>Nama Jabatan</th>
                        <th>Grade</th>
                        <th>Nominal</th>
                         <th style="width: 40px">aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>No.</th>
						<th>Jenis Jabatan</th>
						<th>Nama Jabatan</th>
                        <th>Grade</th>
                        <th>Nominal</th>
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
            pageLength: 100,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            ajax: {
                url: '{{ route("jabatan-tukin.datatable") }}',
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
                    data: 'jenis_jabatan',
                    name: 'jenis_jabatan',
                    class: 'text-center'
                },
				{
                    data: 'nama_jabatan',
                    name: 'nama_jabatan',
                    class: 'text-center'
                },
				{
                    data: 'grade',
                    name: 'grade',
                    class: 'text-center'
                },
                {
                    data: 'nominal',
                    name: 'nominal',
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
                            toastr['error']('Data Jabatan Tukin gagal di hapus!');
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
                url: "{{ url('jabatan-tukin') }}/" + id,
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
                reject('Gagal menghapus data Jabatan Tukin!');
            })
        })
    }
</script>
@endpush

