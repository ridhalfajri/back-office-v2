<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Pendidikan</h3>
        <div class="card-options">
            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                    class="fe fe-maximize"></i></a>
            <div class="item-action dropdown ml-2">
                <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('pendidikan.create', $pegawai->id) }}" class="dropdown-item"><i
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
                    <table id="tbl-pendidikan"
                        class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pendidikan</th>
                                <th>Nama Instansi</th>
                                <th>Tanggal Ijazah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Pendidikan</th>
                                <th>Tanggal Ijazah</th>
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
