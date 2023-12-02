@extends('template')

@push('style')
<!-- Plugins css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

    {{-- custom css datatable --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/custom.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
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
                <div class="card-header">
                    <h4 class="card-title">
                        <button type="button" class="btn btn-xs btn-primary" id="btn-add"
                        onclick="window.location.href = '{{ route('unit-kerja.create') }}';">
                        <i class="fa fa-plus"></i> Tambah</button>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="tbl-data"
                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Unit Kerja</th>
                            <th>Jenis Unit Kerja</th>
                            <th>Singkatan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Unit Kerja</th>
                            <th>Jenis Unit Kerja</th>
                            <th>Singkatan</th>
                            <th>Keterangan</th>
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
<!-- Data Tables -->
    
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
   
    <script type="text/javascript">
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
                    url: '{{ route('unit-kerja.datatable') }}',
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
                        name: 'unit_kerja.nama',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_jenis_unit',
                        name: 'jenis_unit_kerja.nama',
                        class: 'text-center'
                    },
                    {
                        data: 'singkatan',
                        name: 'unit_kerja.singkatan',
                        class: 'text-center'
                    },
                    {
                        data: 'keterangan',
                        name: 'unit_kerja.keterangan',
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
                                toastr['error']('Data Unit Kerja gagal di hapus!');
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
                });
            });
        
    })

    function delete_data(id) {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: "{{ url('master/unit-kerja') }}/" + id,
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
                    reject('Gagal menghapus data Unit Kerja!');
                })
            })
        }
</script>
@endpush

