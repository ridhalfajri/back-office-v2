@extends('template')
@push('style')
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">

    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" />
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush
@push('breadcrumb')
    <ol class="breadcrumb custom-background-color">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="section-body  py-4">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="card-body">
                            <label class="form-label"><i>Export Data Tukin Txt</i></label>
                            {{-- export txt --}}
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
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
                
                                <div class="col-3">
                                    <div class="form-group">
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

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card card-collapsed">
                                <div class="card-status bg-blue"></div>
                                <div class="card-header">
                                    <h3 class="card-title">Generate Tukin</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                                class="fe fe-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group   col-lg-3 col-md-3 col-sm-6">
                                            <label>Range Generate Tukin</label>
                                            <input class="form-control input-daterange-datepicker" type="text"
                                                name="tanggal" id="tanggal" value="">
                                            {{-- <button class="btn btn-sm btn-primary mt-2"
                                                id="generate_tukin">Generate Gaji dan Tukin</button> --}}
                                            <button class="btn btn-sm btn-primary mt-2"
                                                id="generate_tukin_only">Generate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">FILTER</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group multiselect_div col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-label">Unit Kerja</label>
                                            <select id="unit_kerja" name="unit_kerja"
                                                class="select-filter multiselect multiselect-custom">
                                                <option value="">Semua</option>
                                                @foreach ($unit_kerja as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">

                            <div class="table-responsive mb-4">
                                <table id="tbl-pegawai"
                                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Pegawai</th>
                                            <th class="font-weight-bold text-dark">NIP</th>
                                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                                            <th class="font-weight-bold text-dark">Jabatan</th>
                                            <th class="font-weight-bold text-dark">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Pegawai</th>
                                            <th class="font-weight-bold text-dark">NIP</th>
                                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                                            <th class="font-weight-bold text-dark">Jabatan</th>
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
        </div>
    </div>
@endsection
@push('script')
    {{-- Multiselect --}}
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        "use strict"

        $('#bulan').select2({
            width: 'resolve'
        });

        $('#tahun').select2({
            width: 'resolve'
        });

        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',
            locale: {
                format: 'DD-MM-YYYY'
            },
            autoApply: true
        });
        let table;
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $('#unit_kerja').on('change', () => {
            pegawai();

        })
        $(function() {
            pegawai();
        })
        const pegawai = () => {
            table = $('#tbl-pegawai').DataTable({
                processing: true,
                destroy: true,
                serverSide: true,
                deferRender: true,
                responsive: true,
                pageLength: 10,
                paging: true,
                searching: true,
                ordering: true,
                searchDelay: 1000,
                info: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('penghasilan.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        unit_kerja: $('#unit_kerja').val(),
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                    },
                    {
                        data: 'nip',
                        name: 'nip',
                    },
                    {
                        data: 'unit_kerja',
                        name: 'uk.nama',
                    },
                    {
                        data: 'jabatan',
                        name: 'ttj.tipe_jabatan',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        class: 'text-center actions'
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

        // $('#generate_tukin').on('click', () => {
        //     Swal.fire({
        //         title: "Apakah anda yakin?",
        //         text: "Generate Tukin Periode " + $('#tanggal').val(),
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Yes"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: '{{ route('penghasilan.generate-tukin') }}',
        //                 type: "POST",
        //                 headers: {
        //                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //                 },
        //                 data: {
        //                     tanggal: $('#tanggal').val()
        //                 },
        //                 success: function(response) {
        //                     if (response.errors) {
        //                         if (response.errors.connection) {

        //                             Swal.fire({
        //                                 title: 'Error!',
        //                                 text: response.errors.connection,
        //                                 icon: 'error',
        //                                 confirmButtonText: 'Tutup'
        //                             })
        //                         }
        //                         if (response.errors.exists) {
        //                             Swal.fire({
        //                                 title: 'Error!',
        //                                 text: response.errors.exists,
        //                                 icon: 'error',
        //                                 confirmButtonText: 'Tutup'
        //                             })
        //                         }
        //                     } else {
        //                         Swal.fire({
        //                             title: 'Berhasil!',
        //                             text: response.success,
        //                             icon: 'success',
        //                             confirmButtonText: 'Tutup'
        //                         })
        //                     }
        //                 },
        //             });
        //         }
        //     });


        // })

        $('#generate_tukin_only').on('click', () => {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Generate Tukin Periode " + $('#tanggal').val(),
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
                        url: '{{ route('penghasilan.generate-tukin-only') }}',
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            tanggal: $('#tanggal').val()
                        },
                        success: function(response) {
                            // Menutup tanda loading
                            Swal.close();

                            if (response.errors) {
                                if (response.errors.connection) {

                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.errors.connection,
                                        icon: 'error',
                                        confirmButtonText: 'Tutup'
                                    })
                                }
                                if (response.errors.exists) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.errors.exists,
                                        icon: 'error',
                                        confirmButtonText: 'Tutup'
                                    })
                                }
                            } else {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.success,
                                    icon: 'success',
                                    confirmButtonText: 'Tutup'
                                })
                            }
                        },
                        error: function() {
                            // Menutup tanda loading
                            Swal.close();

                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat men-generate.',
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            });
                        }
                    });
                }
            });


        })

        //export data txt
        $('#exportTxt').on('click', function(e) {
                e.preventDefault();
                let tahun = $("#tahun").val();
                let bulan = $("#bulan").val();

                window.location.href = '{{ url('penghasilan/export-to-txt/tukin') }}/' + tahun + '/' +
                bulan;
            });
    </script>
@endpush
