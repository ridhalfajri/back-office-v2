@extends('template')
@push('style')
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
                        <div class="col-lg-12">
                            {{-- <th>No.</th>
                            <th>Tanggal Presensi</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Kekurangan Jam</th>
                            <th>Nominal Potongan</th>
                            <th>Status Kehadiran</th>
                            <th>keterangan</th>
                             --}}
                             <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive mb-4">
                                        <table id="tbl-riwayat-cuti"
                                            class="table table-hover js-basic-example dataTable table_custom spacing5">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                                    <th class="font-weight-bold text-dark">Tanggal Presensi</th>
                                                    <th class="font-weight-bold text-dark">Jam Masuk</th>
                                                    <th class="font-weight-bold text-dark">Jam Pulang</th>
                                                    <th class="font-weight-bold text-dark">Kekurangan Jam</th>
                                                    <th class="font-weight-bold text-dark">Nominal Potongan</th>
                                                    <th class="font-weight-bold text-dark">Status Kehadiran</th>
                                                    <th class="font-weight-bold text-dark">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="font-weight-bold text-dark">No</th>
                                                    <th class="font-weight-bold text-dark">Tanggal Presensi</th>
                                                    <th class="font-weight-bold text-dark">Jam Masuk</th>
                                                    <th class="font-weight-bold text-dark">Jam Pulang</th>
                                                    <th class="font-weight-bold text-dark">Kekurangan Jam</th>
                                                    <th class="font-weight-bold text-dark">Nominal Potongan</th>
                                                    <th class="font-weight-bold text-dark">Status Kehadiran</th>
                                                    <th class="font-weight-bold text-dark">Keterangan</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            </tbody>
                                        </table>

                                        <table id="tbl-riwayat-cuti2"
                                        class="table table-hover js-basic-example dataTable table_custom spacing5">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                                <th class="font-weight-bold text-dark">Pengajuan</th>
                                                <th class="font-weight-bold text-dark">Jenis Cuti</th>
                                                <th class="font-weight-bold text-dark">Tanggal Awal</th>
                                                <th class="font-weight-bold text-dark">Tanggal Akhir</th>
                                                <th class="font-weight-bold text-dark">Status</th>
                                                <th class="font-weight-bold text-dark">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="font-weight-bold text-dark">No</th>
                                                <th class="font-weight-bold text-dark">Pengajuan</th>
                                                <th class="font-weight-bold text-dark">Jenis Cuti</th>
                                                <th class="font-weight-bold text-dark">Tanggal Awal</th>
                                                <th class="font-weight-bold text-dark">Tanggal Akhir</th>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
        let table;

        $(function() {


            var dateAwal = '2023-12-01';
            var dateAkhir = '2023-12-30';



            table = $('#tbl-riwayat-cuti').DataTable({
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
                    url: '{{ route("presensi-pegawai.datatable") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        date_awal: dateAwal,
                        date_akhir: dateAkhir
                    },
                },
                columns: [
                    {
                        data: 'no',
                        name: 'no',
                        className: 'text-center'
                    },
                    {
                        data: 'tanggal_presensi',
                        name: 'tanggal_presensi',
                    },
                    {
                        data: 'jam_masuk',
                        name: 'jam_masuk',
                    },
                    {
                        data: 'jam_pulang',
                        name: 'jam_pulang',
                    },
                    {
                        data: 'kekurangan_jam',
                        name: 'kekurangan_jam',
                    },
                    {
                        data: 'nominal_potongan',
                        name: 'nominal_potongan',
                    },
                    {
                        data: 'status_kehadiran',
                        name: 'status_kehadiran',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
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



        })
    </script>

@endpush
