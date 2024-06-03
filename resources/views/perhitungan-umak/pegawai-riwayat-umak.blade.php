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

    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" />
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
                    {{-- card-header --}}
                    <div class="card-body">
                        <label class="form-label"><i>Export Data Txt</i></label>
                        {{-- export txt --}}
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Awal Export</label>
                                    <input type="date" class="form-control" id="tgl_awal" name = "tgl_awal" placeholder="Pilih Tanggal"/>
            
                                </div>
                            </div>
            
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Akhir Export</label>
                                    <input type="date" class="form-control" id="tgl_akhir" name = "tgl_akhir" placeholder="Pilih Tanggal"/>
            
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Aksi</label>
                                    <button type="button" id="exportTxt" class="btn btn-success waves-effect waves-light">
                                        Export to Txt
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        @if (session('message'))
                            <div class="alert alert-warning">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <label class="form-label"><i>Perhitungan Uang Makan</i></label>
                        {{-- <form method="post" action="{{ route('pegawai-riwayat-umak.kalkulasi-umak') }}"
                            enctype="multipart/form-data" accept-charset="utf-8">
                            @csrf --}}
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('tanggal')has-error @enderror">
                                    <label class="form-label">Periode</label>
                                    <input class="form-control input-daterange-datepicker" type="text" name="tanggal"
                                        id="tanggal" value="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('kalkulasi')has-error @enderror">
                                    <label class="form-label">Aksi</label>
                                    <button type="submit" id="kalkulasi"
                                        class="btn btn-primary btn-sm waves-effect waves-light">Kalkulasi Seluruh
                                        Pegawai</button>
                                    {{-- @if (Carbon\Carbon::now()->format('m') != '01')
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Kalkulasi Seluruh Pegawai</button>
                                    @else
                                    <button disabled class="btn btn-primary btn-sm waves-effect waves-light">Kalkulasi Seluruh Pegawai</button>
                                    @endif --}}
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <label class="form-label" style="color: orange;"><i>Note</i> :<br>
                                    Harap teliti dalam meng-<i>input</i> tanggal <i>cut off</i> untuk uang makan di
                                    Desember ke-2 dan di Februari.<br><br>
                                    
                                    Total Uang Makan sudah dikurangi pajak 5%.
                                </label>

                            </div>
                        </div>

                        {{-- </form> --}}
                    </div>

                    <div class="card-body">
                        <label class="form-label"><i>Filter Datatable</i></label>
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('bulan')has-error @enderror">
                                    <label class="form-label">Bulan</label>
                                    <select id="bulan" name="bulan" class="form-control">
                                        <option value="01"@if (Carbon\Carbon::now()->format('m') == '01') selected @endif>
                                            Januari</option>
                                        <option value="02"@if (Carbon\Carbon::now()->format('m') == '02') selected @endif>
                                            Februari
                                        </option>
                                        <option value="03"@if (Carbon\Carbon::now()->format('m') == '03') selected @endif>
                                            Maret
                                        </option>
                                        <option value="04"@if (Carbon\Carbon::now()->format('m') == '04') selected @endif>
                                            April
                                        </option>
                                        <option value="05"@if (Carbon\Carbon::now()->format('m') == '05') selected @endif>
                                            Mei
                                        </option>
                                        <option value="06"@if (Carbon\Carbon::now()->format('m') == '06') selected @endif>
                                            Juni
                                        </option>
                                        <option value="07"@if (Carbon\Carbon::now()->format('m') == '07') selected @endif>
                                            Juli
                                        </option>
                                        <option value="08"@if (Carbon\Carbon::now()->format('m') == '08') selected @endif>
                                            Agustus
                                        </option>
                                        <option value="09"@if (Carbon\Carbon::now()->format('m') == '09') selected @endif>
                                            September
                                        </option>
                                        <option value="10"@if (Carbon\Carbon::now()->format('m') == '10') selected @endif>
                                            Oktober
                                        </option>
                                        <option value="11"@if (Carbon\Carbon::now()->format('m') == '11') selected @endif>
                                            November
                                        </option>
                                        <option value="12"@if (Carbon\Carbon::now()->format('m') == '12') selected @endif>
                                            Desember
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('tahun')has-error @enderror">
                                    <label class="form-label">Tahun</label>
                                    <select id="tahun" name="tahun" class="form-control">
                                        @for ($a = Carbon\Carbon::now()->format('Y'); $a >= Carbon\Carbon::now()->format('Y') - 4; $a--)
                                            @if ($a == Carbon\Carbon::now()->format('Y'))
                                                <option value="{{ $a }}" selected>{{ $a }}
                                                </option>
                                            @else
                                                <option value="{{ $a }}">{{ $a }}
                                                </option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
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
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="box-title" style="text-align: center;"><b>List Riwayat Uang Makan Pegawai</b></h5>

                        <table id="tbl-data" class="table table-hover js-basic-example dataTable table_custom spacing5">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Nama Pegawai</th>
                                    <th class="font-weight-bold text-dark">NIP</th>
                                    <th class="font-weight-bold text-dark">Unit Kerja</th>
                                    <th class="font-weight-bold text-dark">Uang Makan<br>Harian</th>
                                    <th class="font-weight-bold text-dark">Jumlah Hari<br>Masuk</th>
                                    <th class="font-weight-bold text-dark">Total</th>
                                    <th class="font-weight-bold text-dark">Periode</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                                    <th class="font-weight-bold text-dark">Nama Pegawai</th>
                                    <th class="font-weight-bold text-dark">NIP</th>
                                    <th class="font-weight-bold text-dark">Unit Kerja</th>
                                    <th class="font-weight-bold text-dark">Uang Makan<br>Harian</th>
                                    <th class="font-weight-bold text-dark">Jumlah Hari<br>Masuk</th>
                                    <th class="font-weight-bold text-dark">Total</th>
                                    <th class="font-weight-bold text-dark">Periode</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                        <br>
                        <button type="button" id="exportExcel" class="btn btn-success waves-effect waves-light">
                            Export to Excel
                        </button>

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
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        "use strict"
        let table;

        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',
            locale: {
                format: 'DD-MM-YYYY'
            },
            autoApply: true
        });

        $('#bulan').select2({
            width: 'resolve'
        });

        $('#tahun').select2({
            width: 'resolve'
        });

        $('#unitKerja').select2({
            width: 'resolve'
        });

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
                    url: '{{ route('pegawai-riwayat-umak.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function(d) {
                        //untuk on change datatable
                        d.bulan = $('#bulan').val();
                        d.tahun = $('#tahun').val();
                        d.unitKerja = $('#unitKerja').val();
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
                        data: 'unit_kerja',
                        name: 'uk.nama',
                        class: 'text-center'
                    },
                    {
                        data: 'nominal',
                        name: 'um.nominal',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'jumlah_hari',
                        name: 'jumlah_hari',
                        class: 'text-center'
                    },
                    {
                        data: 'total',
                        name: 'total',
                        class: 'text-center',
                        render: $.fn.dataTable.render.number('.', ',', 2, 'Rp')
                    },
                    {
                        data: 'periode',
                        name: 'periode',
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

            //untuk on change datatable
            $('#bulan').change(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#tahun').change(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#unitKerja').change(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            //export data excel
            $('#exportExcel').on('click', function(e) {
                e.preventDefault();
                let bulan = $("#bulan").val();
                let tahun = $("#tahun").val();
                let unitKerjaId = $("#unitKerja").val();

                if (null === unitKerjaId || '' === unitKerjaId) {
                    window.location.href = '{{ url('kalkulasi/export-to-excel/umak') }}/' + bulan + '/' +
                        tahun;
                } else {
                    window.location.href = '{{ url('kalkulasi/export-to-excel/umak') }}/' + bulan + '/' +
                        tahun + '/' + unitKerjaId;
                }
            });

            //export data txt
            $('#exportTxt').on('click', function(e) {
                e.preventDefault();
                let tgl_awal = $("#tgl_awal").val();
                let tgl_akhir = $("#tgl_akhir").val();

                window.location.href = '{{ url('kalkulasi/export-to-txt/umak') }}/' + tgl_awal + '/' +
                    tgl_akhir;
            });

            //pop up kalkulasi umak
            $('#kalkulasi').on('click', () => {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Kalkulasi Uang Makan Pegawai " + $('#tanggal').val(),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Menampilkan tanda loading
                        let loadingSwal = Swal.fire({
                            title: 'Loading...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });

                        $.ajax({
                            url: '{{ route('pegawai-riwayat-umak.kalkulasi-umak') }}',
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {
                                tanggal: $('#tanggal').val()
                            },
                            success: function(response) {
                                Swal.close();

                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.success,
                                    icon: 'success',
                                    confirmButtonText: 'Tutup'
                                })
                                $("#tbl-data").DataTable().ajax.reload();
                            },
                            error: function() {
                                // Menutup tanda loading
                                Swal.close();

                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat mengkalkulasi.',
                                    icon: 'error',
                                    confirmButtonText: 'Tutup'
                                });
                            }
                        });
                    }
                });
            })

        });
    </script>
@endpush
