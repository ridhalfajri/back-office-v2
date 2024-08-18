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
                                onclick="window.location.href = '{{ route('pengajuan-regular-bpjs.create') }}';">
                                Pengajuan</button>
                        </h4>
                    </div>

                    <div class="card-body">
                        <em style="color: red">Pengajuan Anggota Regular: Pegawai Bersangkutan, Suami/Istri, dan Anak
                            (sampai anak
                            ke-3).</em>
                        <br>
                        <em style="color: black">Jika Status 'Daftar Ke BPJS', Silahkan Cek Berkala Aplikasi Mobile
                            JKN.</em>
                        <br>
                        <br>

                        <h5 class="box-title" style="text-align: center;"><b>List Pengajuan BPJS Regular</b></h5>

                        <table id="tbl-data" class="table table-hover js-basic-example dataTable table_custom spacing5">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Nama</th>
                                    <th class="font-weight-bold text-dark">NIK</th>
                                    <th class="font-weight-bold text-dark">No. KK</th>
                                    <th class="font-weight-bold text-dark">Status Hubungan<br>Keluarga</th>
                                    <th class="font-weight-bold text-dark">Email</th>
                                    <th class="font-weight-bold text-dark">No. Telp</th>
                                    <th class="font-weight-bold text-dark">Kode Faskes</th>

                                    <th class="font-weight-bold text-dark">Status</th>
                                    <th class="font-weight-bold text-dark">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Nama</th>
                                    <th class="font-weight-bold text-dark">NIK</th>
                                    <th class="font-weight-bold text-dark">No. KK</th>
                                    <th class="font-weight-bold text-dark">Status Hubungan<br>Keluarga</th>
                                    <th class="font-weight-bold text-dark">Email</th>
                                    <th class="font-weight-bold text-dark">No. Telp</th>
                                    <th class="font-weight-bold text-dark">Kode Faskes</th>

                                    <th class="font-weight-bold text-dark">Status</th>
                                    <th class="font-weight-bold text-dark">Aksi</th>
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
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        "use strict"
        let table;

        $(function() {
            // $('#unitKerja').select2({
            //     width: 'resolve'
            // });

            // $('#isAktif').select2({
            //     width: 'resolve'
            // });


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
                    url: '{{ route('pengajuan-regular-bpjs.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    // data: function(d) {
                    //     //untuk on change datatable
                    //     d.unitKerja = $('#unitKerja').val();
                    //     d.isAktif = $('#isAktif').val();
                    // }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        class: 'text-center'
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        class: 'text-center'
                    },
                    {
                        data: 'no_kk',
                        name: 'no_kk',
                        class: 'text-center'
                    },
                    {
                        data: 'status_hubungan',
                        name: 'status_hubungan',
                        class: 'text-center'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        class: 'text-center'
                    },
                    {
                        data: 'no_telepon',
                        name: 'no_telepon',
                        class: 'text-center'
                    },
                    {
                        data: 'kode_faskes',
                        name: 'kode_faskes',
                        class: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
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

            //untuk on change
            // $('#unitKerja').change(function(e) {
            //     e.preventDefault();
            //     table.ajax.reload();
            // });

            // $('#isAktif').change(function(e) {
            //     e.preventDefault();
            //     table.ajax.reload();
            // });

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
                                toastr['error'](
                                    'Data Pengajuan BPJS Regular gagal di hapus!');
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
                    url: "{{ url('pengajuan-bpjs/pengajuan-regular-bpjs') }}/" + id,
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
                    reject('Gagal menghapus data Pengajuan BPJS Regular!');
                })
            })
        }
    </script>
@endpush
