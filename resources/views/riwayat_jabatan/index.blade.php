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
                            {{-- <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold ">DATA PEGAWAI</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3 col-lg-3">
                                            <label class="form-label">Nama</label>
                                            <p>#</p>
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3">
                                            <label class="form-label">NIP</label>
                                            <p>#</p>
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3">
                                            <label class="form-label">Unit Kerja</label>
                                            <p>#</p>
                                        </div>
                                        <div class="form-group col-md-3 col-lg-3">
                                            <label class="form-label">Jabatan</label>
                                            <p>#</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="table-responsive mb-4">
                                <table id="tbl-riwayat-jabatan"
                                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Jabatan</th>
                                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                                            <th class="font-weight-bold text-dark">Tanggal SK</th>
                                            <th class="font-weight-bold text-dark">Pelantikan</th>
                                            <th class="font-weight-bold text-dark">TMT Jabatan</th>
                                            <th class="font-weight-bold text-dark">PLT</th>
                                            <th class="font-weight-bold text-dark">Status</th>
                                            <th class="font-weight-bold text-dark">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%" class="font-weight-bold text-dark">No</th>
                                            <th class="font-weight-bold text-dark">Jabatan</th>
                                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                                            <th class="font-weight-bold text-dark">Tanggal SK</th>
                                            <th class="font-weight-bold text-dark">Pelantikan</th>
                                            <th class="font-weight-bold text-dark">TMT Jabatan</th>
                                            <th class="font-weight-bold text-dark">PLT</th>
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
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
        let table;

        $(function() {
            table = $('#tbl-riwayat-jabatan').DataTable({
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
                    url: '{{ route('riwayat-jabatan.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'tipe_jabatan',
                        name: 'ttj.tipe_jabatan',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_unit_kerja',
                        name: 'uk.nama',
                        class: 'text-center'
                    },
                    {
                        data: 'tanggal_sk',
                        name: 'tanggal_sk',
                        class: 'text-center'
                    },
                    {
                        data: 'tanggal_pelantikan',
                        name: 'tanggal_pelantikan',
                        class: 'text-center'
                    },
                    {
                        data: 'tmt_jabatan',
                        name: 'tmt_jabatan',
                        class: 'text-center'
                    },
                    {
                        data: 'is_plt',
                        name: 'is_plt',
                        class: 'text-center',
                        render: function(data, type, row) {
                            switch (data) {
                                case 1:
                                    return '<span class="badge badge-pill badge-primary">YA</span>';
                                    break;
                                case 0:
                                    return '<span class="badge badge-pill badge-dark">TIDAK</span>';
                                    break;
                            }
                        }
                    },
                    {
                        data: 'is_now',
                        name: 'is_now',
                        class: 'text-center',
                        render: function(data, type, row) {
                            switch (data) {
                                case 1:
                                    return '<span class="badge badge-pill badge-success">AKTIF</span>';
                                    break;
                                case 0:
                                    return '<span class="badge badge-pill badge-dark">TIDAK AKTIF</span>';
                                    break;
                            }
                        }
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
        })
    </script>
    <script>
        const show_cuti = (id) => {
            $.ajax({
                url: "/cuti/pengajuan_cuti/" + id,
                type: "GET",
                success: function(response) {
                    console.log(response);
                    if (response.errors) {
                        if (response.errors) {
                            Swal.fire({
                                title: "Gagal!",
                                text: response.errors.connection,
                                icon: "error",
                                confirmButtonText: "Tutup",
                            });
                        }
                    } else if (response.result) {
                        const res = response.result
                        $('#c_jenis_cuti').val(res.jenis)
                        $('#c_tanggal_awal_cuti').val(res.tanggal_awal_cuti)
                        $('#c_tanggal_akhir_cuti').val(res.tanggal_akhir_cuti)
                        $('#c_lama_cuti').val(res.lama_cuti)
                        $('#c_alasan').val(res.alasan)
                        $('#c_alamat_cuti').val(res.alamat_cuti)
                        $('#c_no_telepon_cuti').val(res.no_telepon_cuti)
                        $('#c_tanggal_approve_al').val(res.tanggal_approve_al)
                        $('#c_tanggal_approve_akb').val(res.tanggal_approve_akb)
                        $('#c_tanggal_penolakan_cuti').val(res.tanggal_penolakan_cuti)
                        $('#c_keterangan').val(res.keterangan)
                        if (res.media_pengajuan_cuti) {
                            $("#c_media_pengajuan_cuti").attr(
                                "href",
                                "//" + response.result.media_pengajuan_cuti
                            );
                        }
                    }
                },
            });
        }
    </script>
@endpush
