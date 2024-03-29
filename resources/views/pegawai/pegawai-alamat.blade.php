    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Alamat Domisili</h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                        class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                        class="fe fe-maximize"></i></a>
                <div class="item-action dropdown ml-2">
                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item btn-alamat" data-toggle="modal"
                            data-target="#modal-alamat" id="btn-domisili" onclick="domisili()"><i
                                class="dropdown-icon fa fa-edit"></i>
                            Ubah</a>
                    </div>
                </div>
            </div>
        </div>
        @if ($alamat_domisili != null)
            <div class="card-body">
                <div class="row clearfix">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Propinsi</label>
                            <input type="text" class="form-control" disabled="" placeholder="Propinsi"
                                value="{{ $alamat_domisili->propinsi->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Kota/Kab.</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kota/Kab."
                                value="{{ $alamat_domisili->kota->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kecamatan"
                                value="{{ $alamat_domisili->kecamatan->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Desa</label>
                            <input type="text" class="form-control" disabled="" placeholder="Desa"
                                value="{{ $alamat_domisili->desa->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kode Pos"
                                value="{{ $alamat_domisili->kode_pos }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea rows="3" class="form-control" disabled="" placeholder="Alamat Lengkap"> {{ $alamat_domisili->alamat }}</textarea>
                        </div>
                    </div>
                    @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 7 ||
                            auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                        @if ($alamat_domisili->is_verified)
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label class="form-label">Verifikasi Alamat</label>
                                    <button class="btn btn-success btn-sm" type="button" disabled>Sukses</button>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label class="form-label">Verifikasi Alamat</label>
                                    <a href="{{ route('alamat.verifikasi-sdmoh', $alamat_domisili->id) }}"
                                        class="btn btn-primary btn-sm">Verifikasi</a>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-3">

                            <div class="form-group">
                                <label class="form-label">Verifikasi Alamat</label>
                                @if ($alamat_domisili->is_verified)
                                    <input type="text" class="form-control" disabled="" placeholder="Kode Pos"
                                        value="Telah Diverifikasi SDMOH" style="background-color: #00eb0c">
                                @else
                                    <input type="text" class="form-control" disabled="" placeholder="Kode Pos"
                                        value="Menunggu Verifikasi SDMOH" style="background-color: #ffd91c">
                                @endif

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Alamat Asal</h3>
            <div class="card-options">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                        class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                        class="fe fe-maximize"></i></a>
                <div class="item-action dropdown ml-2">
                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item " data-toggle="modal"
                            data-target="#modal-alamat" id="btn-asal" onclick="asal()"><i
                                class="dropdown-icon fa fa-edit"></i>
                            Ubah</a>
                    </div>
                </div>
            </div>
        </div>
        @if ($alamat_asal != null)
            <div class="card-body">
                <div class="row clearfix">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Propinsi</label>
                            <input type="text" class="form-control" disabled="" placeholder="Propinsi"
                                value="{{ $alamat_asal->propinsi->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-label">Kota/Kab.</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kota/Kab."
                                value="{{ $alamat_asal->kota->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kecamatan"
                                value="{{ $alamat_asal->kecamatan->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Desa</label>
                            <input type="text" class="form-control" disabled="" placeholder="Desa"
                                value="{{ $alamat_asal->desa->nama }}">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" disabled="" placeholder="Kode Pos"
                                value="{{ $alamat_asal->kode_pos }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea rows="3" class="form-control" disabled="" placeholder="Alamat Lengkap"> {{ $alamat_asal->alamat }}</textarea>
                        </div>
                    </div>
                    @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 7 ||
                            auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                        @if ($alamat_asal->is_verified)
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label class="form-label">Verifikasi Alamat</label>
                                    <button class="btn btn-success btn-sm" type="button" disabled>Sukses</button>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label class="form-label">Verifikasi Alamat</label>
                                    <a href="{{ route('alamat.verifikasi-sdmoh', $alamat_asal->id) }}"
                                        class="btn btn-primary btn-sm">Verifikasi</a>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-3">

                            <div class="form-group">
                                <label class="form-label">Verifikasi Alamat</label>
                                @if ($alamat_asal->is_verified)
                                    <input type="text" class="form-control" disabled="" placeholder="Kode Pos"
                                        value="Telah Diverifikasi SDMOH" style="background-color: #00eb0c">
                                @else
                                    <input type="text" class="form-control" disabled="" placeholder="Kode Pos"
                                        value="Menunggu Verifikasi SDMOH" style="background-color: #ffd91c">
                                @endif

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
