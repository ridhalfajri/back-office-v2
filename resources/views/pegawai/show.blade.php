@extends('template')
@push('style')
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    {{-- File Upload --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}">
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card card-profile">
                        <div class="card-body text-center">
                            <img class="card-profile-img" src="../assets/images/sm/avatar1.jpg" alt="" />
                            <h4 class="mb-3">{{ $pegawai->nama_depan . ' ' . $pegawai->nama_belakang }}</h4>
                            <p class="mb-4">{{ $pegawai->email_kantor . ' | ' . $pegawai->no_telp }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body  py-4">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-12">
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-alamat-tab" data-toggle="pill" href="#pills-alamat" role="tab"
                                aria-controls="pills-alamat" aria-selected="true">Alamat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-diklat-tab" data-toggle="pill" href="#pills-diklat" role="tab"
                                aria-controls="pills-diklat" aria-selected="true">Diklat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-tmt-gaji-tab" data-toggle="pill" href="#pills-tmt-gaji"
                                role="tab" aria-controls="pills-tmt-gaji" aria-selected="true">TMT Gaji</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-pendidikan-tab" data-toggle="pill" href="#pills-pendidikan"
                                role="tab" aria-controls="pills-pendidikan" aria-selected="true">Pendidikan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-keluarga-tab" data-toggle="pill" href="#pills-keluarga"
                                role="tab" aria-controls="pills-keluarga" aria-selected="true">Keluarga</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-penghargaan-tab" data-toggle="pill" href="#pills-penghargaan"
                                role="tab" aria-controls="pills-penghargaan" aria-selected="true">Penghargaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-thp-tab" data-toggle="pill" href="#pills-thp" role="tab"
                                aria-controls="pills-thp" aria-selected="true">THP</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Profile</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-fullscreen"
                                            data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                        <div class="item-action dropdown ml-2">
                                            <a href="javascript:void(0)" data-toggle="dropdown"><i
                                                    class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fa fa-drivers-license-o"></i> Curriculum
                                                    Vitae</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i
                                                        class="dropdown-icon fa fa-edit"></i> Ubah</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <input type="hidden" id="pegawai_id" class="form-control" disabled=""
                                                placeholder="Id" value="{{ $pegawai->id }}">
                                            <div class="form-group">
                                                <label class="form-label">NIK</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="NIK" value="{{ $pegawai->nik }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">NIP</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="NIP" value="{{ $pegawai->nip }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">NPWP</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="NPWP" value="{{ $pegawai->npwp }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nama Depan</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Nama Depan" value="{{ $pegawai->nama_depan }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nama Belakang</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Nama Belakang" value="{{ $pegawai->nama_belakang }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Jenis Kelamin" value="{{ $pegawai->jenis_kelamin }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Agama</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Agama" value="{{ $pegawai->agama->nama }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Golongan Darah</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Golongan Darah" value="{{ $pegawai->golongan_darah }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Status Nikah</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Status Menikah"
                                                    value="{{ $pegawai->jenis_kawin->nama }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Tempat, Tanggal Lahir</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Tempat, Tanggal Lahir" disabled=""
                                                    value="{{ $pegawai->tempat_lahir . ', ' . $pegawai->tanggal_lahir }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Email Kantor</label>
                                                <input type="email" class="form-control" disabled=""
                                                    placeholder="Email" value="{{ $pegawai->email_kantor }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Email Pribadi</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Email Pribadi" value="{{ $pegawai->email_pribadi }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">No Telepon</label>
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="Email Pribadi" value="{{ $pegawai->no_telp }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-7">
                                            <div class="form-group">
                                                <label class="form-label">Jenis Pegawai</label>
                                                <input type="text" class="form-control" placeholder="Jenis Pegawai"
                                                    disabled="" value="{{ $pegawai->jenis_pegawai->nama }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Status Pegawai</label>
                                                <input type="text" class="form-control" placeholder="Status Pegawai"
                                                    disabled="" value="{{ $pegawai->status_pegawai->nama }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Status Dinas</label>
                                                <input type="text" class="form-control" placeholder="Status Dinas"
                                                    disabled="" value="{{ $pegawai->status_dinas }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Tanggal Berhenti</label>
                                                <input type="text" class="form-control" placeholder="Tanggal Berhenti"
                                                    disabled="" value="{{ $pegawai->tanggal_berhenti }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Tanggal Wafat</label>
                                                <input type="text" class="form-control" placeholder="Tanggal Wafat"
                                                    disabled="" value="{{ $pegawai->tanggal_wafat }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">No BPJS</label>
                                                <input type="text" class="form-control" placeholder="Tanggal Wafat"
                                                    disabled="" value="{{ $pegawai->no_bpjs }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">No Taspen</label>
                                                <input type="text" class="form-control" placeholder="No Taspen"
                                                    disabled="" value="{{ $pegawai->no_taspen }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">No Fingerprint</label>
                                                <input type="text" class="form-control" placeholder="No Fingerprint"
                                                    disabled="" value="{{ $pegawai->no_fingerprint }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Kartu Pegawai</label>
                                                <input type="text" class="form-control" placeholder="Kartu Pegawai"
                                                    disabled="" value="{{ $pegawai->no_kartu_pegawai }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-alamat" role="tabpanel" aria-labelledby="pills-alamat-tab">
                            @include('pegawai.pegawai-alamat')
                        </div>
                        <div class="tab-pane fade" id="pills-diklat" role="tabpanel" aria-labelledby="pills-diklat-tab">
                            @include('pegawai.pegawai-diklat')
                        </div>
                        <div class="tab-pane fade" id="pills-tmt-gaji" role="tabpanel"
                            aria-labelledby="pills-tmt-gaji-tab">
                            @include('pegawai.tmt_gaji.pegawai-tmt-gaji')
                        </div>
                        <div class="tab-pane fade" id="pills-pendidikan" role="tabpanel"
                            aria-labelledby="pills-pendidikan-tab">
                            @include('pegawai.pendidikan.pegawai-riwayat-pendidikan')
                        </div>
                        <div class="tab-pane fade" id="pills-keluarga" role="tabpanel"
                            aria-labelledby="pills-keluarga-tab">
                            @include('pegawai.keluarga.pegawai-keluarga')
                        </div>
                        <div class="tab-pane fade" id="pills-penghargaan" role="tabpanel"
                            aria-labelledby="pills-penghargaan-tab">
                            @include('pegawai.penghargaan.pegawai-penghargaan')
                        </div>
                        <div class="tab-pane fade" id="pills-thp" role="tabpanel" aria-labelledby="pills-thp-tab">
                            @include('pegawai.thp.index')
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="widgets1">
                                <div class="icon">
                                    <i class="icon-trophy text-success font-30"></i>
                                </div>
                                <div class="details">
                                    <h6 class="mb-0 font600">Total Earned</h6>
                                    <span class="mb-0">$96K +</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="widgets1">
                                <div class="icon">
                                    <i class="icon-heart text-warning font-30"></i>
                                </div>
                                <div class="details">
                                    <h6 class="mb-0 font600">Total Likes</h6>
                                    <span class="mb-0">6,270</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="widgets1">
                                <div class="icon">
                                    <i class="icon-handbag text-danger font-30"></i>
                                </div>
                                <div class="details">
                                    <h6 class="mb-0 font600">Delivered</h6>
                                    <span class="mb-0">720 Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="widgets1">
                                <div class="icon">
                                    <i class="icon-user text-primary font-30"></i>
                                </div>
                                <div class="details">
                                    <h6 class="mb-0 font600">Jobs</h6>
                                    <span class="mb-0">614</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Followers</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i
                                        class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i
                                        class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="right_chat list-unstyled mb-0">
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="../assets/images/xs/avatar4.jpg"
                                                alt="">
                                            <div class="media-body">
                                                <span class="name">Donald Gardner</span>
                                                <span class="message">Designer, Blogger</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="offline">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="../assets/images/xs/avatar1.jpg"
                                                alt="">
                                            <div class="media-body">
                                                <span class="name">Nancy Flanary</span>
                                                <span class="message">Art director, Movie Cut</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="../assets/images/xs/avatar3.jpg"
                                                alt="">
                                            <div class="media-body">
                                                <span class="name">Phillip Smith</span>
                                                <span class="message">Writter, Mag Editor</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="../assets/images/xs/avatar4.jpg"
                                                alt="">
                                            <div class="media-body">
                                                <span class="name">Donald Gardner</span>
                                                <span class="message">Designer, Blogger</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="offline">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="../assets/images/xs/avatar1.jpg"
                                                alt="">
                                            <div class="media-body">
                                                <span class="name">Nancy Flanary</span>
                                                <span class="message">Art director, Movie Cut</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="../assets/images/xs/avatar3.jpg"
                                                alt="">
                                            <div class="media-body">
                                                <span class="name">Phillip Smith</span>
                                                <span class="message">Writter, Mag Editor</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@push('modal')
    <!-- Modal Alamat -->
    <div class="modal fade" id="modal-alamat" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="modalAlamatLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alamat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Nama</label>
                                    <input type="text" disabled="" class="form-control mt-3 state-valid"
                                        value="{{ $pegawai->nama_depan . ' ' . $pegawai->nama_belakang }}">
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Tipe Alamat</label>
                                    <div class="form-group multiselect_div">
                                        <input type="text" id="tipe_alamat" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Propinsi</label>
                                    <select id="propinsi_id" name="propinsi_id" class="multiselect multiselect-custom">
                                    </select>
                                    <small class="text-danger" id="error_propinsi_id"></small>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Kota</label>
                                    <select id="kota_id" name="kota_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option selected value="">-- Pilih Kota --</option>
                                    </select>
                                    <small class="text-danger" id="error_kota_id"></small>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Kecamatan</label>
                                    <select id="kecamatan_id" name="kecamatan_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option selected value="">-- Pilih Kecamatan --</option>
                                    </select>
                                    <small class="text-danger" id="error_kecamatan_id"></small>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Desa</label>
                                    <select id="desa_id" name="desa_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option selected value="">-- Pilih Desa --</option>
                                    </select>
                                    <small class="text-danger" id="error_desa_id"></small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="number" id="kode_pos" min="0" step="0.01"
                                        oninput="limitDigits(this, 5);" class="form-control mt-3 state-valid"
                                        value="" placeholder="Kode Pos">
                                    <small class="text-danger" id="error_kode_pos"></small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea id="alamat" rows="3" class="form-control" placeholder="Alamat Lengkap"></textarea>
                                    <small class="text-danger" id="error_alamat"></small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="store-alamat">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Detail Diklat -->
    <div class="modal fade" id="modal-detail-diklat" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailDiklatLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Diklat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Nama</label>
                                    <input type="text" id="d_nama_jenis_diklat" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="text" id="d_tanggal_mulai" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Akhir</label>
                                    <input type="text" id="d_tanggal_akhir" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jam Pelajaran</label>
                                    <input type="text" id="d_jam_pelajaran" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" id="d_lokasi" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Penyelenggara</label>
                                    <input type="text" id="d_penyelenggaran" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nomor Sertifikat</label>
                                    <input type="text" id="d_no_sertifikat" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Sertifikat</label>
                                    <input type="text" id="d_tanggal_sertifikat" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">File Sertifikat</label>
                                    <a href="#" id="d_media_sertifikat" class="btn btn-primary">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Tmt Gaji --}}
    <div class="modal fade" id="modal-tmt-gaji" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="modalTmtLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tmt Gaji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-tmt-gaji" action="{{ route('tmt-gaji.store') }}" action="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden"id="tmt_gaji_id" name="tmt_gaji_id"
                                        class="form-control mt-3 state-valid" value="">
                                    <input type="hidden" name="pegawai_id" class="form-control mt-3 state-valid"
                                        value="{{ $pegawai->id }}">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input type="text" disabled="" class="form-control mt-3 state-valid"
                                            value="{{ $pegawai->nama_depan . ' ' . $pegawai->nama_belakang }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tmt Gaji</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="date_tmt_gaji" name="tmt_gaji"
                                                data-date-autoclose="true" data-date-format="dd/mm/yyyy"
                                                class="form-control datepicker_tmt">
                                        </div>
                                        <small class="text-danger" id="error_tmt_gaji"></small>
                                    </div>
                                    <div class="form-group multiselect_div">
                                        <label class="form-label">Gaji</label>
                                        <div class="form-group multiselect_div">
                                            <select id="gaji_id" name="gaji_id" class="multiselect multiselect-custom">
                                            </select>
                                        </div>
                                        <small class="text-danger" id="error_gaji_id"></small>

                                    </div>
                                    <div class="form-group">
                                        <div class="form-label">Status</div>
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="is_active"
                                                    value="1">
                                                <span class="custom-control-label">Aktif</span>
                                            </label>
                                            <label class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" name="is_active"
                                                    checked="" value="0">
                                                <span class="custom-control-label">Tidak Aktif</span>
                                            </label>
                                        </div>
                                        <small class="text-danger" id="error_is_active"></small>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-6 col-sm-12">
                                        <label class="form-label">SK TMT Gaji</label>
                                        <div class="input-group">
                                            <input type="file" id="media_tmt_gaji" name="media_tmt_gaji">
                                            <a id="download_media_tmt_gaji" href="">Download</a>
                                            <small class="text-danger" id="error_media_tmt_gaji"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Modal Pendidikan --}}
    <div class="modal fade" id="modal-detail-pendidikan" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailPendidikanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pendidikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Pendidikan</label>
                                    <input type="text" id="p_pendidikan" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Instansi</label>
                                    <input type="text" id="p_nama_instansi" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Propinsi</label>
                                    <input type="text" id="p_propinsi" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kota</label>
                                    <input type="text" id="p_kota" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" id="p_alamat" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kode Gelar Depan</label>
                                    <input type="text" id="p_kode_gelar_depan" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kode Gelar Belakang</label>
                                    <input type="text" id="p_kode_gelar_belakang" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No Ijazah</label>
                                    <input type="text" id="p_no_ijazah" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Ijazah</label>
                                    <input type="text" id="p_tanggal_ijazah" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">File Sertifikat</label>
                                    <a href="#" id="p_media_ijazah" class="btn btn-primary">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Pasangan --}}
    <div class="modal fade bd-example-modal-lg" id="modal-detail-pasangan" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailPasanganLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pasangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Nama Pasangan</label>
                                        <input type="text" id="si_nama" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">NIK</label>
                                        <input type="text" id="si_nik" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" id="si_tempat_lahir" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="text" id="si_tanggal_lahir" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Kawin</label>
                                        <input type="text" id="si_tanggal_kawin" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jenis Kawin</label>
                                        <input type="text" id="si_jenis_kawin" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">No Buku Nikah</label>
                                        <input type="text" id="si_no_buku_nikah" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">No Kartu</label>
                                        <input type="text" id="si_no_kartu" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">PNS</label>
                                        <input type="text" id="si_is_pns" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Pendidikan</label>
                                        <input type="text" id="si_pendidikan" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Pekerjaan</label>
                                        <input type="text" id="si_pekerjaan" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Status Tunjangan</label>
                                        <input type="text" id="si_status_tunjangan" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">No SK Cerai</label>
                                        <input type="text" id="si_no_sk_cerai" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">TMT SK Cerai</label>
                                        <input type="text" id="si_tmt_sk_cerai" disabled=""
                                            class="form-control mt-3 state-valid" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Buku Nikah</label>
                                        <a href="#" id="si_media_buku_nikah" class="btn btn-primary">Download</a>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Foto Pasangan</label>
                                        <div id="foto_pasangan"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Anak --}}
    <div class="modal fade" id="modal-detail-anak" tabindex="-1" role="dialog" aria-labelledby="modalDetailAnakLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Anak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Nama Anak</label>
                                    <input type="text" id="an_nama" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">NIK</label>
                                    <input type="text" id="an_nik" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" id="an_tempat_lahir" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="text" id="an_tanggal_lahir" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Anak Ke</label>
                                    <input type="text" id="an_anak_ke" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status Anak</label>
                                    <input type="text" id="an_status_anak" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status Tunjangan</label>
                                    <input type="text" id="an_status_tunjangan" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Pendidikan</label>
                                    <input type="text" id="an_pendidikan" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Bidang Studi</label>
                                    <input type="text" id="an_bidang_studi" disabled=""
                                        class="form-control mt-3 state-valid" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Penghargaan --}}
    <div class="modal fade" id="modal-tambah-penghargaan" tabindex="-1" role="dialog"
        aria-labelledby="modalDetailPenghargaanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Penghargaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-penghargaan" action="{{ route('penghargaan.store') }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" id="id_penghargaan" name="id_penghargaan">
                                    <input type="hidden" name="pegawai_id" value="{{ $pegawai->id }}">
                                    <div class="form-group multiselect_div">
                                        <label class="form-label">Penghargaan</label>
                                        <select id="penghargaan_id" name="penghargaan_id"
                                            class="select-filter multiselect multiselect-custom">
                                            <option selected value="">-- Pilih Kota --</option>
                                        </select>
                                        <small class="text-danger" id="error_penghargaan_id"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nomor SK</label>
                                        <input type="text" id="no_sk" name="no_sk"
                                            class="form-control mt-3 state-valid" value="" placeholder="Nomor SK">
                                        <small class="text-danger" id="error_no_sk"></small>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tanggal SK</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tanggal_sk" name="tanggal_sk"
                                                data-date-autoclose="true" data-date-format="dd-mm-yyyy"
                                                class="form-control datepicker" placeholder="Tanggal SK">
                                        </div>
                                        <small class="text-danger" id="error_tanggal_sk"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Tahun</label>
                                        <input type="number" id="tahun" min="0" step="0.01"
                                            oninput="limitDigits(this, 4);" class="form-control state-valid"
                                            value="" name="tahun" placeholder="Tahun">
                                        <small class="text-danger" id="error_tahun"></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">SK Penghargaan</label>
                                        <div class="input-group">
                                            <input type="file" id="media_sk_penghargaan" name="media_sk_penghargaan">
                                            <small class="text-danger" id="error_media_sk_penghargaan"></small>
                                            <a href="" id="download_media_sk_penghargaan">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- File Upload --}}
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/diklat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/alamat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/tmt_gaji.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pendidikan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/keluarga.js') }}"></script>
    <script src="{{ asset('assets/js/custom/penghargaan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/thp.js') }}"></script>


    <script>
        const select_propinsi = (propinsi_id = null) => {
            $.ajax({
                url: "{{ route('propinsi.data') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    propinsi_id: propinsi_id
                },
                success: function(response) {
                    $('#propinsi_id').html(response);
                    $('#propinsi_id').multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 200
                    });
                }
            })
        }
        const select_kota = (id = null, kota_id = null) => {
            $.ajax({
                type: "POST",
                url: "{{ route('kota.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr("content")
                },
                data: {
                    id: id,
                    kota_id: kota_id
                },
                cache: false,
                success: function(response) {
                    $('#kota_id').multiselect('destroy');
                    $('#kota_id').html(response);
                    $('#kota_id').multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 200
                    });
                    resetKecamatan();
                    resetDesa();
                },
                error: function(data) {
                    console.log('error : ', data);
                }
            });
        }
        const select_kecamatan = (id = null, kecamatan_id = null, ) => {
            $.ajax({
                type: "POST",
                url: "{{ route('kecamatan.data') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id: id,
                    kecamatan_id: kecamatan_id
                },
                cache: false,
                success: function(response) {
                    $('#kecamatan_id').multiselect('destroy');
                    $('#kecamatan_id').html(response);
                    $('#kecamatan_id').multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 200
                    });
                    resetDesa();
                },
                error: function(data) {
                    console.log('error : ', data);
                }
            });
        }
        const select_desa = (id = null, desa_id = null) => {
            $.ajax({
                type: "POST",
                url: "{{ route('desa.data') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id: id,
                    desa_id: desa_id
                },
                cache: false,
                success: function(response) {
                    $('#desa_id').multiselect('destroy');
                    $('#desa_id').html(response);
                    $('#desa_id').multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 200
                    });
                },
                error: function(data) {
                    console.log('error : ', data);
                }
            });
        }
        $('#propinsi_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
            select_kota(id)
        });
        $('#kota_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
            select_kecamatan(id)

        });
        $('#kecamatan_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
            select_desa(id)

        });
        const resetKecamatan = function() {
            $('#kecamatan_id').multiselect('destroy');
            $('#kecamatan_id').html('<option selected value="">-- Pilih Kecamatan --</option>');
            $('#kecamatan_id').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                maxHeight: 200
            });
        }
        const resetDesa = function() {
            $('#desa_id').multiselect('destroy');
            $('#desa_id').html('<option selected value="">-- Pilih Desa --</option>');
            $('#desa_id').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                maxHeight: 200
            });
        }



        // {{-- Limit Kode Pos --}}

        function limitDigits(input, maxDigits) {
            const value = input.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
            const parts = value.split('.');

            if (parts[0].length > maxDigits) {
                parts[0] = parts[0].slice(0, maxDigits);
            }

            if (parts[1] && parts[1].length > 2) { // Enforce a maximum of 2 decimal places
                parts[1] = parts[1].slice(0, 2);
            }

            input.value = parts.join('.');
        }
    </script>
    <script>
        $('#pills-tab a').on('click', function(e) {
            e.preventDefault()
            const tab_id = this.getAttribute('id')
            if (tab_id == 'pills-diklat-tab') {
                url = "{{ route('diklat.datatable') }}"
                get_table_diklat(url)
                $(this).tab('show')
            } else if (tab_id == 'pills-tmt-gaji-tab') {
                url = "{{ route('tmt-gaji.datatable') }}"
                pegawai_id = "{{ $pegawai->id }}"
                get_table_tmt_gaji(url, pegawai_id)
            } else if (tab_id == 'pills-pendidikan-tab') {
                url = "{{ route('pendidikan.datatable') }}"
                pegawai_id = "{{ $pegawai->id }}"
                get_table_pendidikan(url, pegawai_id)
            } else if (tab_id == 'pills-keluarga-tab') {
                url_pasangan = "{{ route('pasangan.datatable') }}"
                url_anak = "{{ route('anak.datatable') }}"
                pegawai_id = "{{ $pegawai->id }}"
                get_table_pasangan(url_pasangan, pegawai_id)
                get_table_anak(url_anak, pegawai_id)
            } else if (tab_id == 'pills-penghargaan-tab') {
                url = "{{ route('penghargaan.datatable') }}"
                pegawai_id = "{{ $pegawai->id }}"
                get_table_penghargaan(url, pegawai_id)
            } else if (tab_id == 'pills-thp-tab') {
                url = "{{ route('thp.datatable') }}"
                pegawai_id = "{{ $pegawai->id }}"
                get_table_thp(url, pegawai_id)
            }
        })
    </script>
@endpush
