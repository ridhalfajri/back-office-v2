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
                                            <label class="form-label">Bulan</label>
                                            <select id="bulan" name="bulan"
                                                class="select-filter multiselect multiselect-custom">
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
                                                <option value="05"@if (Carbon\Carbon::now()->format('m') == '05') selected @endif>Mei
                                                </option>
                                                <option value="06"@if (Carbon\Carbon::now()->format('m') == '06') selected @endif>Juni
                                                </option>
                                                <option value="07"@if (Carbon\Carbon::now()->format('m') == '07') selected @endif>Juli
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
                                        <div class="form-group multiselect_div col-lg-6 col-md-6 col-sm-12">
                                            <label class="form-label">Tahun</label>
                                            <select id="tahun" name="tahun"
                                                class="select-filter multiselect multiselect-custom">
                                                @for ($a = Carbon\Carbon::now()->format('Y') + 1; $a >= 2005; $a--)
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
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive mb-4">
                                <table id="tbl-penghasilan-show"
                                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Periode</th>
                                            <th class="font-weight-bold text-dark">Gaji</th>
                                            <th class="font-weight-bold text-dark">Tukin</th>
                                            <th class="font-weight-bold text-dark">Uang Makan</th>
                                            <th class="font-weight-bold text-dark">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Periode</th>
                                            <th class="font-weight-bold text-dark">Gaji</th>
                                            <th class="font-weight-bold text-dark">Tukin</th>
                                            <th class="font-weight-bold text-dark">Uang Makan</th>
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
    <script>
        "use strict"
        let table;
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $(function() {
            pengahsilan_show();
        })
        $('#bulan').on('change', () => {
            pengahsilan_show();

        })
        $('#tahun').on('change', () => {
            pengahsilan_show();

        })
        const pengahsilan_show = () => {
            table = $('#tbl-penghasilan-show').DataTable({
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
                    url: '{{ route('penghasilan.datatable-show-esselon') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        pegawai_id: '{{ $pegawai->id }}',
                        bulan: $('#bulan').val(),
                        tahun: $('#tahun').val(),
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'periode',
                        name: 'periode',
                    },
                    {
                        data: 'gaji',
                        name: 'gaji',
                        render: $.fn.dataTable.render.number(',', '.', 3, 'Rp')
                    },
                    {
                        data: 'tukin',
                        name: 'tukin',
                        render: $.fn.dataTable.render.number(',', '.', 3, 'Rp')

                    },
                    {
                        data: 'total',
                        name: 'total',
                        render: $.fn.dataTable.render.number(',', '.', 3, 'Rp')

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
