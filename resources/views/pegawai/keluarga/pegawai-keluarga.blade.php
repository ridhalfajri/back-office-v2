<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pasangan</h3>
        <div class="card-options">
            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                    class="fe fe-maximize"></i></a>
            <div class="item-action dropdown ml-2">
                <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('pasangan.create', $pegawai->id) }}" class="dropdown-item"><i
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
                    <table id="tbl-pasangan" class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Tunjangan</th>
                                <th>Verifikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Tunjangan</th>
                                <th>Verifikasi</th>
                                <th>Aksi</th>
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

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Anak</h3>
        <div class="card-options">
            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                    class="fe fe-maximize"></i></a>
            <div class="item-action dropdown ml-2">
                <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('anak.create', $pegawai->id) }}" class="dropdown-item"><i
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
                    <table id="tbl-anak" class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Tunjangan</th>
                                <th>Verifikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nik</th>
                                <th>Tunjangan</th>
                                <th>Verifikasi</th>
                                <th>Aksi</th>
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
