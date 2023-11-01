<div class="tab-pane fade show active" id="pills-alamat" role="tabpanel" aria-labelledby="pills-alamat-tab">
    @if (count($pegawai->pegawai_alamat) < 2)
        <button class="btn btn-primary my-2" data-toggle="modal" data-target="#modal-alamat">Tambah</button>
    @endif

    @foreach ($pegawai->pegawai_alamat as $alamat)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Alamat {{ $alamat->tipe_alamat }}</h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                            class="fe fe-maximize"></i></a>
                    <div class="item-action dropdown ml-2">
                        <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i>
                                Ubah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row clearfix">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Propinsi</label>
                            <input type="text" class="form-control" disabled="" placeholder="Propinsi"
                                value="{{ $alamat->propinsi->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Kota/Kab.</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kota/Kab."
                                value="{{ $alamat->kota->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kecamatan"
                                value="{{ $alamat->kecamatan->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Desa</label>
                            <input type="text" class="form-control" disabled="" placeholder="Desa"
                                value="{{ $alamat->desa->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kode Pos"
                                value="{{ $alamat->kode_pos }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea rows="3" class="form-control" disabled="" placeholder="Alamat Lengkap">{{ $alamat->alamat }} </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
