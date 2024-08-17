<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tmt Gaji</h3>
        <div class="card-options">
            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                    class="fe fe-maximize"></i></a>
            <div class="item-action dropdown ml-2">
                @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 7 ||
                        auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item btn-tmt-gaji" data-toggle="modal"
                            data-target="#modal-tmt-gaji" onclick="create_tmt_gaji()"><i
                                class="dropdown-icon fa fa-edit"></i>
                            Tambah</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="table-responsive mb-4">
                    <table id="tbl-tmt-gaji" class="table table-hover js-basic-example dataTable table_custom spacing5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tmt Gaji</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tmt Gaji</th>
                                <th>Nominal</th>
                                <th>Status</th>
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
