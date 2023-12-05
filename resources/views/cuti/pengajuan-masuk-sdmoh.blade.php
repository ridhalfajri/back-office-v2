@extends('template')
@push('style')
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="section-body  py-4">
                <div class="container-fluid">
                    <div class="row clearfix">
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
                                        <div class="form-group multiselect_div col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-label">Status</label>
                                            <select id="status" name="status"
                                                class="select-filter multiselect multiselect-custom">
                                                @foreach ($status_cuti as $item)
                                                    @if ($item->id == 2)
                                                        <option value="{{ $item->id }}" selected>{{ $item->status }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->status }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">

                            <div class="table-responsive mb-4">
                                <table id="tbl-pengajuan-masuk"
                                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Nama</th>
                                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                                            <th class="font-weight-bold text-dark">Pengajuan</th>
                                            <th class="font-weight-bold text-dark">Status</th>
                                            <th class="font-weight-bold text-dark">Jenis Cuti</th>
                                            <th class="font-weight-bold text-dark">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Nama</th>
                                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                                            <th class="font-weight-bold text-dark">Pengajuan</th>
                                            <th class="font-weight-bold text-dark">Status</th>
                                            <th class="font-weight-bold text-dark">Jenis Cuti</th>
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
@push('modal')
@endpush
@push('script')
    {{-- Multiselect --}}
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
        let table;

        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $('#unit_kerja').on('change', () => {
            datatable_pengajuan_masuk();

        })
        $('#status').on('change', () => {
            datatable_pengajuan_masuk();
        })
        $(function() {
            datatable_pengajuan_masuk();
        })

        const datatable_pengajuan_masuk = (unit_kerja = null) => {
            table = $('#tbl-pengajuan-masuk').DataTable({
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
                    url: '{{ route('cuti.datatable-pengajuan-masuk-sdmoh') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        unit_kerja: $('#unit_kerja').val(),
                        status: $('#status').val()
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
                        data: 'nama_unit_kerja',
                        name: 'uk.nama',
                    },
                    {
                        data: 'tanggal_pengajuan',
                        name: 'pegawai_cuti.created_at',
                    },
                    {
                        data: 'status',
                        name: 'status_cuti.status',
                        render: function(data, type, row) {
                            switch (data) {
                                case "Pengajuan":
                                    return '<span class="badge badge-pill badge-warning">' + data +
                                        '</span>';
                                    break;
                                case "Acc Atasan Langsung":
                                    return '<span class="badge badge-pill badge-primary">' + data +
                                        '</span>';
                                    break;
                                case "Acc Kabiro SDMOH":
                                    return '<span class="badge badge-pill badge-success">' + data +
                                        '</span>';
                                    break;
                                case "Cuti Ditolak":
                                    return '<span class="badge badge-pill badge-danger">' + data +
                                        '</span>';
                                    break;
                            }
                        }
                    },
                    {
                        data: 'jenis',
                        name: 'jenis_cuti.jenis',
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
    </script>
@endpush
