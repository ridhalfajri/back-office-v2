@extends('template')
@push('style')
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
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
                        <div class="col-lg-12">
                            <a href="{{ route('cuti.pengajuan-cuti') }}" class="btn btn-primary my-3">Tambah</a>
                            <div class="table-responsive mb-4">
                                <table id="tbl-riwayat-cuti"
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
@endsection
@push('modal')
    {{-- Modal Detail Cuti --}}
    <div class="modal fade" id="modal-detail-cuti" tabindex="-1" role="dialog" aria-labelledby="modalDetailCutiLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Cuti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Jenis Cuti</label>
                                    <input type="text" id="c_jenis_cuti" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Awal</label>
                                    <input type="text" id="c_tanggal_awal_cuti" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Akhir</label>
                                    <input type="text" id="c_tanggal_akhir_cuti" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Lama Cuti</label>
                                    <input type="text" id="c_lama_cuti" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alasan</label>
                                    <input type="text" id="c_keterangan_cuti_p" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Yang Bersangkutan</label>
                                    <input type="text" id="c_detail_keterangan_cuti_p" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alasan Lengkap</label>
                                    <input type="text" id="c_alasan" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat Cuti</label>
                                    <input type="text" id="c_alamat_cuti" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No Telp Cuti</label>
                                    <input type="text" id="c_no_telepon_cuti" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Acc Atasan Langsung</label>
                                    <input type="text" id="c_tanggal_approve_al" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Acc Kabiro SDMOH</label>
                                    <input type="text" id="c_tanggal_approve_akb" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Penolakan Cuti</label>
                                    <input type="text" id="c_tanggal_penolakan_cuti" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" id="c_keterangan" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Lampiran Pengajuan Cuti</label>
                                    <a href="#" id="c_media_pengajuan_cuti" class="btn btn-primary">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
        let table;

        $(function() {
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
                    url: '{{ route('cuti.datatable-riwayat-cuti') }}',
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
                        data: 'tanggal_pengajuan',
                        name: 'pegawai_cuti.created_at',
                    },
                    {
                        data: 'jenis',
                        name: 'jenis_cuti.jenis',
                    },
                    {
                        data: 'tanggal_awal_cuti',
                        name: 'tanggal_awal_cuti',
                    },
                    {
                        data: 'tanggal_akhir_cuti',
                        name: 'tanggal_akhir_cuti',
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
        const delete_cuti = (id) => {
            Swal.fire({
                title: "Apakah anda yakin hapus pengajuan cuti ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                confirmButtonColor: "#DC3444",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/cuti/pengajuan_cuti/" + id,
                        type: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": '{{ csrf_token() }}',
                        },
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.errors) {
                                if (response.errors) {
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.errors.connection,
                                        icon: "error",
                                        confirmButtonText: "Tutup",
                                    });
                                }
                            } else if (response.success) {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.success,
                                    icon: "success",
                                    confirmButtonText: "Tutup",
                                });
                                $("#tbl-riwayat-cuti").DataTable().ajax.reload();
                            }
                        },
                        error: function(response) {
                            Swal.fire({
                                title: "Gagal!",
                                text: 'Terjadi Kesalahan',
                                icon: "error",
                                confirmButtonText: "Tutup",
                            });
                        }
                    });
                }
            });
        };
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
                        $('#c_keterangan_cuti_p').val(res.keterangan_cuti_p)
                        $('#c_detail_keterangan_cuti_p').val(res.detail_keterangan_cuti_p)
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
