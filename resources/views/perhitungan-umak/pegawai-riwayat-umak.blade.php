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
                {{-- card-header --}}
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
                    <form method="post" action="{{ route('pegawai-riwayat-umak.kalkulasi-umak') }}"
                        enctype="multipart/form-data" accept-charset="utf-8">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('periode')has-error @enderror">
                                    <label class="form-label">Periode</label>
                                    <input type="text" name="periode" id="periode"
                                        value="{{ Carbon\Carbon::now()->format('F') }} - {{ Carbon\Carbon::now()->format('Y') }}" class="form-control"
                                        maxlength="255" readonly="true"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('tahunCalc')has-error @enderror">
                                    <label class="form-label">Aksi</label>
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Kalkulasi Seluruh Pegawai</button>
                                    {{-- @if (Carbon\Carbon::now()->format('d') == '06')
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Kalkulasi Seluruh Pegawai</button>
                                    @else
                                    <button disabled class="btn btn-primary btn-sm waves-effect waves-light">Kalkulasi Seluruh Pegawai</button>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </form>
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
                                    @for ($a = Carbon\Carbon::now()->format('Y'); $a >= Carbon\Carbon::now()->format('Y')-4; $a--)
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
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="tbl-data"
                    class="table table-hover js-basic-example dataTable table_custom spacing5">
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
                        //untuk on change berubah data tablenya
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
    })

    
</script>
@endpush

