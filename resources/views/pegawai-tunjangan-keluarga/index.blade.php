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
                    {{-- <div class="card-header">
                    <h4 class="card-title">
                        <button type="button" class="btn btn-xs btn-primary" id="btn-add"
                        onclick="window.location.href = '{{ route('pegawai-tambahan-mk.create') }}';">
                        Pengajuan</button>
                    </h4>
                </div> --}}

                    <div class="card-body">
                        <label class="form-label"><i>Filter Datatable</i></label>
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('unitKerja')has-error @enderror">
                                    <label class="form-label">Unit Kerja</label>
                                    <select id="unitKerja" name="unitKerja" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($dataUnitKerja as $data)
                                            {{-- @if (old('unitKerja') == $data->id)
                                        <option value="{{ $data->id }}" selected>{{ $data->nama }}</option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endif --}}

                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('status')has-error @enderror">
                                    <label class="form-label">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1" selected>Pengajuan</option>
                                        <option value="2">Ditolak</option>
                                        <option value="3">Disetujui</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="box-title" style="text-align: center;"><b>List Persetujuan Tunjangan Keluarga</b>
                        </h5>

                        <table id="tbl-data" class="table table-hover js-basic-example dataTable table_custom spacing5">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Nama Pegawai</th>
                                    <th class="font-weight-bold text-dark">NIP</th>
                                    <th class="font-weight-bold text-dark">Unit Kerja</th>
                                    <th class="font-weight-bold text-dark">Nama</th>
                                    <th class="font-weight-bold text-dark">NIK</th>
                                    <th class="font-weight-bold text-dark">No. KK</th>
                                    <th class="font-weight-bold text-dark">Status<br>Keluarga</th>
                                    <th class="font-weight-bold text-dark">Tgl Lahir</th>
                                    <th class="font-weight-bold text-dark">Tgl<br>Perkawinan</th>

                                    <th class="font-weight-bold text-dark">Status</th>
                                    <th class="font-weight-bold text-dark">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Nama Pegawai</th>
                                    <th class="font-weight-bold text-dark">NIP</th>
                                    <th class="font-weight-bold text-dark">Unit Kerja</th>
                                    <th class="font-weight-bold text-dark">Nama</th>
                                    <th class="font-weight-bold text-dark">NIK</th>
                                    <th class="font-weight-bold text-dark">No. KK</th>
                                    <th class="font-weight-bold text-dark">Status<br>Keluarga</th>
                                    <th class="font-weight-bold text-dark">Tgl Lahir</th>
                                    <th class="font-weight-bold text-dark">Tgl<br>Perkawinan</th>

                                    <th class="font-weight-bold text-dark">Status</th>
                                    <th class="font-weight-bold text-dark">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>

                        {{-- <br>
                        <button type="button" id="exportExcel" class="btn btn-success waves-effect waves-light">
                            Export to Excel
                        </button> --}}
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
            $('#unitKerja').select2({
                width: 'resolve'
            });

            $('#status').select2({
                width: 'resolve'
            });

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
                    url: '{{ route('pegawai-tunjangan-keluarga.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function(d) {
                        //untuk on change datatable
                        d.unitKerja = $('#unitKerja').val();
                        d.status = $('#status').val();
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai',
                        class: 'text-center'
                    },
                    {
                        data: 'nip',
                        name: 'p.nip',
                        class: 'text-center'
                    },
                    {
                        data: 'singkatan_unit_kerja',
                        name: 'uk.singkatan',
                        class: 'text-center'
                    },
                    {
                        data: 'nama',
                        name: 'ptm.nama',
                        class: 'text-center'
                    },
                    {
                        data: 'nik',
                        name: 'ptm.nik',
                        class: 'text-center'
                    },
                    {
                        data: 'no_kk',
                        name: 'ptm.no_kk',
                        class: 'text-center'
                    },
                    {
                        data: 'status_keluarga',
                        name: 'ptm.status_keluarga',
                        class: 'text-center'
                    },
                    {
                        data: 'tgl_lahir',
                        name: 'ptm.tgl_lahir',
                        class: 'text-center'
                    },
                    {
                        data: 'tgl_perkawinan',
                        name: 'ptm.tgl_perkawinan',
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
            $('#unitKerja').change(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#status').change(function(e) {
                e.preventDefault();
                table.ajax.reload();
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
                                toastr['error'](
                                    'Data Pengajuan Tunjangan Keluarga gagal dihapus!');
                            } else {
                                table.ajax.reload();
                                toastr['success'](hasil.status.message);
                            }
                        }).catch(function(err) {
                            console.log(err);
                        })

                    } else {
                        swal('Informasi', 'Membatalkan data dihapus', 'error');
                    }
                });
            });

        })

        function delete_data(id) {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: "{{ url('pegawai-tunjangan-keluarga') }}/" + id,
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
                    reject('Gagal menghapus data Pengajuan Tunjangan Keluarga!');
                })
            })
        }
    </script>
@endpush
