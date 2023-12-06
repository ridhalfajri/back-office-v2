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
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
            <a href="{{ route('pre-ijin.index') }}" class="btn btn-light"><i class="fa fa-list"></i> Presensi Tidak Tercatat</a>
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

                    <div class="row rowData">
                        <div class="col-sm-2">
                            <strong>Kuota Ijin Kehadiran dan Presensi Tidak Tercatat</strong>
                        </div>
                        <div class="col-sm-4">
                            :
                            @if($totalKuota>=3)
                                <strong class="btn btn-danger">{{ $totalKuota  }} dari 3</strong>
                            @else
                                <strong class="btn btn-success">{{ $totalKuota  }} dari 3</strong>
                            @endif
                        </div>
                    </div>

                    @break
                @endforeach

                {{-- <div class="row rowdata">
                    <div class="col-sm-2">
                        <strong>Unit Kerja</strong>
                    </div>

                    <div class="col-sm-10">
                        <select class="form-control" id="jabatan_unit_kerja_id" name="jabatan_unit_kerja_id" required>
                            @foreach ($pegawai as $data)
                                <option value="{{ $data->id }}" {{ (old('jabatan_unit_kerja_id') == $data->id || $data->is_plt == 0)? 'selected' : '' }}>{{ $data->nama_unit_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}


            </div>
        </div>

        <div class="card-body">

            <h5><strong>Riwayat Presensiku Tidak Tercatat<strong></h5>

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

        @if(session('warning'))
            toastr['warning']('{{ session("warning") }}');
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
                    name: 'Tanggal Pengajuan'
                },
                {
                    data: 'jam_perubahan',
                    name: 'Jam Perubahan'
                },
                {
                    data: 'jenis',
                    name: 'Jenis'
                },
                {
                    data: 'status',
                    name: 'Status'
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

