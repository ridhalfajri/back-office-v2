<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Jabatan</h3>
        <div class="card-options">
            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                    class="fe fe-maximize"></i></a>
            <div class="item-action dropdown ml-2">
                <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('a-riwayat-jabatan.create', $pegawai->id) }}" class="dropdown-item"><i
                            class="dropdown-icon fa fa-edit"></i>
                        Tambah</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="row clearfix">
            <div class="col-lg-12">
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
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
