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
                <li class="breadcrumb-item"><a href="{{ route('pre-dinas-luar.index') }}">Riwayat Dinas Luar</a></li>
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

                <div class="row rowdata">
                    <div class="col-sm-2">
                        <strong>Unit Kerja</strong>
                    </div>

                    <div class="col-sm-10">
                        <select class="form-control" id="hirarki_unit_kerja_id" name="hirarki_unit_kerja_id"  data-id="{{ $data->id }}" required>
                            <option value="0" selected disabled>Pilih Unit Kerja</option>
                            @foreach ($pegawai as $data)
                                <option value="{{ $data->hirarki_unit_kerja_id }}" {{ old('hirarki_unit_kerja_id') == $data->hirarki_unit_kerja_id ? '' : '' }} >{{ $data->nama_unit_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>
        </div>


        <div class="card-body">
            <h5><strong>Riwayat Persetujuan Dinas Luar Berdasarkan Unit Kerja<strong></h5>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label>Filter Dari Tanggal : </label>
                        <input type="date" class="form-control" id="date_awal" name = "date_awal" placeholder="Pilih Tanggal"/>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label>Sampai Tanggal : </label>
                        <input type="date" class="form-control" id="date_akhir" name = "date_akhir" placeholder="Pilih Tanggal"/>

                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label>Nama Pegawai : </label>
                        <select class="form-control" id="pegawai_id" name="pegawai_id" required>
                            <option value="" selected>Semua</option>
                        </select>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-group">
                        <label>Status Persetujuan : </label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected>Semua</option>
                            <option value="1" selected>Pengajuan</option>
                            <option value="2" selected>Disetujui</option>
                            <option value="3" selected>Ditolak</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row rowdata">
                <div class="col-6">
                    <button class="btn btn-primary" id="btnShowData"><i class="fa fa-search" aria-hidden="true"></i> Cari Data</button>
                </div>
            </div>


        </div>


        <div class="card-body">
            <br>
            <!-- /.dropdown js__dropdown -->
            <table id="tbl-data" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">nip</th>
                        <th rowspan="2">nama</th>
						<th colspan="2" class="text-center">Tanggal Dinas</th>
						<th rowspan="2">nama kegiatan</th>
						<th rowspan="2">lokasi</th>
                        <th rowspan="2">status approval</th>
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
                        <th>nip</th>
                        <th>nama</th>
						<th>Dari Tanggal</th>
                        <th>Sampai Tanggal</th>
                        <th>jam presensi</th>
                        <th>jenis presensi</th>
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

<script>
    let table;

   setTimeout(function() {
        var hirarki_unit_kerja_id = @json($pegawai[0]->hirarki_unit_kerja_id);
        $('#hirarki_unit_kerja_id').val(hirarki_unit_kerja_id);
        // Trigger the change event for Select2
        $('#hirarki_unit_kerja_id').trigger('change');
    }, 1000);

</script>

<script type="text/javascript">
    "use strict"

    $(document).ready(function() {
        table = $('#tbl-data').DataTable();
        $('#hirarki_unit_kerja_id').select2();

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


        $('#btnShowData').on('click', function() {
            showDataPresensi();
            getAnggotaTim();
        });


        $('#hirarki_unit_kerja_id').on('change', function(e) {
            e.preventDefault();

            //===================

            var selectElement = document.getElementById('status');
            selectElement.selectedIndex = 0; //semua sebagai default

            // Get the select element
            var selectElement = $('#pegawai_id');
                // Clear existing options
                selectElement.empty();

                // Add a default option
                var defaultOption = $('<option>', {
                    value: '',
                    text: 'Semua'
                });
                selectElement.append(defaultOption);
            //===================
            showDataPresensi();
            getAnggotaTim();

        });
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

        $('#tbl-data').delegate('button.setujui', 'click', function(e) {
            e.preventDefault();

            var that = $(this);

            swal({
                title: 'Konfirmasi!',
                text: 'Apakah anda yakin ingin menyetujui pengajuan dinas luar tersebut?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#78c0ec',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    confirmasi(that.data('id'),2).then(function(hasil) {
                        console.log('Test');
                        if (hasil.status.error == true) {
                            toastr['error']('Gagal menyutujui!');
                        } else {
                            table.ajax.reload();
                            toastr['success'](hasil.status.message);
                        }
                    }).catch(function(err) {
                        console.log(err);
                    })

                } else {
                    swal('Informasi', 'Konfirmasi persetujuan dibatalkan', 'error');
                }
            })
        });

        $('#tbl-data').delegate('button.tolak', 'click', function(e) {
            e.preventDefault();

            var that = $(this);

            swal({
                title: 'Konfirmasi!',
                text: 'Apakah anda yakin ingin menolak pengajuan dinas luar tersebut?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    confirmasi(that.data('id'),3).then(function(hasil) {

                        if (hasil.status.error == true) {
                            toastr['error']('Proses simpan data gagal!');
                        } else {
                            table.ajax.reload();
                            toastr['success'](hasil.status.message);
                        }
                    }).catch(function(err) {
                        console.log(err);
                    })

                } else {
                    swal('Informasi', 'Konfirmasi persetujuan dibatalkan', 'error');
                }
            })
        });

        $('#tbl-data').delegate('button.batal', 'click', function(e) {
            e.preventDefault();

            var that = $(this);

            swal({
                title: 'Konfirmasi!',
                text: 'Apakah anda yakin ingin membatalkan keputusan yang telah ditetapkan sebelumnya?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#78c0ec',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                closeOnConfirm: true,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    confirmasi(that.data('id'),1).then(function(hasil) {

                        if (hasil.status.error == true) {
                            toastr['error']('Proses update data gagal!');
                        } else {
                            table.ajax.reload();
                            toastr['success'](hasil.status.message);
                        }
                    }).catch(function(err) {
                        console.log(err);
                    })

                } else {
                    swal('Informasi', 'Konfirmasi persetujuan dibatalkan', 'error');
                }
            })
        });

    });

    function showDataPresensi(){

        var dateAwal = document.getElementById('date_awal').value;
        var dateAkhir = document.getElementById('date_akhir').value;
        var selectedPegawaiId = document.getElementById('pegawai_id').value;

        var UnitKerja = document.getElementById('hirarki_unit_kerja_id');
        var hirarkiUnitKerjaId = UnitKerja.value;
        var pimpinanId = @json($pegawai[0]->id);
        var sts_pengajuan = document.getElementById('status').value;

        table.destroy();

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
                    url: '{{ route("pre-dinas-luar.datatablepersetujuan") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{
                        hirarki_unit_kerja_id: hirarkiUnitKerjaId,
                        pimpinan_Id : pimpinanId,
                        date_awal: dateAwal,
                        date_akhir: dateAkhir,
                        pegawai_id : selectedPegawaiId,
                        status_pengajuan: sts_pengajuan,
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
                        name: 'Nip',
                    },
                    {
                        data: 'nama',
                        name: 'Nama',
                    },
                    {
                        data: 'tanggal_dinas_awal',
                        name: 'Tanggal Dinas Awal',
                    },
                    {
                        data: 'tanggal_dinas_akhir',
                        name: 'Tanggal Dinas Akhir',
                    },
                    {
                        data: 'nama_kegiatan',
                        name: 'Nama Kegiatan',
                    },
                    {
                        data: 'lokasi',
                        name: 'Lokasi',
                    },
                    {
                        data: 'status_approve',
                        name: 'status_approve',
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
        }

    function getAnggotaTim() {

        var selectedUnitKerjaId = document.getElementById('hirarki_unit_kerja_id').value;
        var pimpinanId = @json($pegawai[0]->id);

        // Parameters to be sent in the request body
        var requestData = {
        pimpinan_id: pimpinanId,
        hirarki_unit_kerja_id: selectedUnitKerjaId
        };


        // Make an AJAX request using jQuery
        $.ajax({
        url: '{{ route("presensi-pegawai.getanggotatim") }}',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data:{
            pimpinan_id: pimpinanId,
            hirarki_unit_kerja_id: selectedUnitKerjaId
        },
        success: function(data) {

            // Get the select element
            var selectElement = $('#pegawai_id');
            // Clear existing options
            selectElement.empty();

            // Add a default option
            var defaultOption = $('<option>', {
                value: '',
                text: 'Semua'
            });
            selectElement.append(defaultOption);

            // Add an option for each data item
            $.each(data, function(index, item) {
                var option = $('<option>', {
                    value: item.pegawai_id,
                    text: item.nama_depan + ' ' + item.nama_belakang
                });
                selectElement.append(option);
            });

            // Set the default option as selected
            defaultOption.prop('selected', true);
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
        });

    }


    function confirmasi(id,jwb) {
        return new Promise(function(resolve, reject) {

            var pimpinanId = @json($pegawai[0]->hirarki_unit_kerja_id);

            $.ajax({
                url: "/presensi/pre-dinas-luar/konfirmasi",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                data: {
                    id: id,
                    status: jwb,
                    atasan_id: pimpinanId
                }
            }).done(function(hasil) {
                resolve(hasil);
            }).fail(function() {
                reject('Gagal!');
            })
        })
    }

</script>
@endpush

