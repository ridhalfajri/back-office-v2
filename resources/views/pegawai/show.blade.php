@extends('template')
@push('style')
<<<<<<< HEAD
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
=======
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
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
<<<<<<< HEAD
                            <a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-alamat-tab" data-toggle="pill" href="#pills-alamat"
                                role="tab" aria-controls="pills-alamat" aria-selected="true">Alamat</a>
=======
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
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="tab-content" id="pills-tabContent">
<<<<<<< HEAD
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
=======
                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Profile</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                                class="fe fe-maximize"></i></a>
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
<<<<<<< HEAD
=======
                                            <input type="hidden" id="pegawai_id" class="form-control" disabled=""
                                                placeholder="Id" value="{{ $pegawai->id }}">
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                            <div class="form-group">
                                                <label class="form-label">NIK</label>
                                                <input type="text" class="form-control" disabled="" placeholder="NIK"
                                                    value="{{ $pegawai->nik }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">NIP</label>
                                                <input type="text" class="form-control" disabled="" placeholder="NIP"
                                                    value="{{ $pegawai->nip }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">NPWP</label>
<<<<<<< HEAD
                                                <input type="text" class="form-control" disabled="" placeholder="NPWP"
                                                    value="{{ $pegawai->npwp }}">
=======
                                                <input type="text" class="form-control" disabled=""
                                                    placeholder="NPWP" value="{{ $pegawai->npwp }}">
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
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
<<<<<<< HEAD
                        @include('pegawai.pegawai-alamat')
=======
                        <div class="tab-pane fade" id="pills-alamat" role="tabpanel" aria-labelledby="pills-alamat-tab">
                            @include('pegawai.pegawai-alamat')
                        </div>
                        <div class="tab-pane fade" id="pills-diklat" role="tabpanel" aria-labelledby="pills-diklat-tab">
                            @include('pegawai.pegawai-diklat')
                        </div>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
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
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <!-- Modal -->
    <div class="modal fade" id="modal-alamat" tabindex="-1" role="dialog" aria-labelledby="modalAlamatLabel"
        aria-hidden="true">
=======
@endsection
@push('modal')
    <!-- Modal Alamat -->
    <div class="modal fade" id="modal-alamat" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="modalAlamatLabel" aria-hidden="true">
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
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
<<<<<<< HEAD
                                        <select id="single-selection" name="single_selection"
                                            class="multiselect multiselect-custom">
                                            <option value="Domisili">Domisili</option>
                                            <option value="Asal">Asal</option>
                                        </select>
=======
                                        <input type="text" id="tipe_alamat" disabled=""
                                            class="form-control mt-3 state-valid" value="">
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                    </div>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Propinsi</label>
                                    <select id="propinsi_id" name="propinsi_id" class="multiselect multiselect-custom">
                                    </select>
<<<<<<< HEAD
=======
                                    <small class="text-danger" id="error_propinsi_id"></small>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Kota</label>
                                    <select id="kota_id" name="kota_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option selected value="">-- Pilih Kota --</option>
                                    </select>
<<<<<<< HEAD
=======
                                    <small class="text-danger" id="error_kota_id"></small>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Kecamatan</label>
                                    <select id="kecamatan_id" name="kecamatan_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option selected value="">-- Pilih Kecamatan --</option>
                                    </select>
<<<<<<< HEAD
=======
                                    <small class="text-danger" id="error_kecamatan_id"></small>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Desa</label>
                                    <select id="desa_id" name="desa_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option selected value="">-- Pilih Desa --</option>
                                    </select>
<<<<<<< HEAD
=======
                                    <small class="text-danger" id="error_desa_id"></small>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="number" id="kode_pos" min="0" step="0.01"
                                        oninput="limitDigits(this, 5);" class="form-control mt-3 state-valid"
                                        value="" placeholder="Kode Pos">
<<<<<<< HEAD
=======
                                    <small class="text-danger" id="error_kode_pos"></small>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea id="alamat" rows="3" class="form-control" placeholder="Alamat Lengkap"></textarea>
<<<<<<< HEAD
=======
                                    <small class="text-danger" id="error_alamat"></small>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
<<<<<<< HEAD
                    <button type="button" class="btn btn-primary" id="store-alamat"
                        onclick="select_propinsi()">Simpan</button>
=======
                    <button type="button" class="btn btn-primary" id="store-alamat">Simpan</button>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
@endsection
@push('script')
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script>
        $('#single-selection').multiselect({
            maxHeight: 300
        });
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $('#modal-alamat').on('show.bs.modal', function(e) {
            select_propinsi();
            $('#modal-alamat').modal('show');

        })

        let select_propinsi = function() {
            $.ajax({
                url: "{{ route('propinsi.data') }}",
                type: 'GET',
                success: function(response) {
                    let option = '<option selected value="">-- Pilih Propinsi --</option>';
                    for (let i = 0; i < response.result.length; i++) {
                        option +=
                            `<option value="${response.result[i].id}">${response.result[i].nama}</option>`;
                    }
                    $('#propinsi_id').append(option);
=======
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
@endpush
@push('script')
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/js/custom/diklat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/alamat.js') }}"></script>

    <script>
        const get_data_alamat = (tipe_alamat) => {
            $.ajax({
                url: "{{ route('alamat.get-data-by-pegawai-id') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    pegawai_id: <?= $pegawai->id ?>,
                    tipe_alamat: tipe_alamat
                },
                success: function(response) {
                    if (response.result == null) {
                        $('#tipe_alamat').val(tipe_alamat)
                    } else {
                        set_data_edit(response)
                    }
                }
            })
        }
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
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                    $('#propinsi_id').multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 200
                    });
                }
            })
        }
<<<<<<< HEAD
        $('#propinsi_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
=======
        const select_kota = (id = null, kota_id = null) => {
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
            $.ajax({
                type: "POST",
                url: "{{ route('kota.data') }}",
                headers: {
<<<<<<< HEAD
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id: id
=======
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr("content")
                },
                data: {
                    id: id,
                    kota_id: kota_id
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
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
<<<<<<< HEAD

=======
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                },
                error: function(data) {
                    console.log('error : ', data);
                }
            });
<<<<<<< HEAD
        });


        $('#kota_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
=======
        }
        const select_kecamatan = (id = null, kecamatan_id = null, ) => {
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
            $.ajax({
                type: "POST",
                url: "{{ route('kecamatan.data') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
<<<<<<< HEAD
                    id: id
=======
                    id: id,
                    kecamatan_id: kecamatan_id
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
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
<<<<<<< HEAD
        });
        $('#kecamatan_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
=======
        }
        const select_desa = (id = null, desa_id = null) => {
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
            $.ajax({
                type: "POST",
                url: "{{ route('desa.data') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
<<<<<<< HEAD
                    id: id
=======
                    id: id,
                    desa_id: desa_id
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
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
<<<<<<< HEAD
=======
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

>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
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
        $('body').on('click', '#store-alamat', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('alamat.store') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    tipe_alamat: $('#tipe_alamat').val(),
                    propinsi_id: $('#propinsi_id').val(),
                    kota_id: $('#kota_id').val(),
                    kecamatan_id: $('#kecamatan_id').val(),
                    desa_id: $('#desa_id').val(),
                    kode_pos: $('#kode_pos').val(),
                    alamat: $('#alamat').val(),
<<<<<<< HEAD
                },
                success: function(response) {}
=======
                    pegawai_id: <?= json_encode($pegawai->id) ?>
                },
                success: function(response) {
                    if (response.errors) {
                        resetForm()
                        const err = response.errors
                        if (err.propinsi_id) {
                            $('#error_propinsi_id').text(err.propinsi_id)
                        }
                        if (err.kota_id) {
                            $('#error_kota_id').text(err.kota_id)
                        }
                        if (err.kecamatan_id) {
                            $('#error_kecamatan_id').text(err.kecamatan_id)
                        }
                        if (err.desa_id) {
                            $('#error_desa_id').text(err.desa_id)
                        }
                        if (err.kode_pos) {
                            $('#error_kode_pos').text(err.kode_pos)
                        }
                        if (err.alamat) {
                            $('#error_alamat').text(err.alamat)
                        }
                        if (err.connection) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.errors.connection,
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            })
                        }
                    } else {
                        resetForm(true)
                        Swal.fire({
                            title: 'Tersimpan!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Tutup'
                        })
                        setTimeout(function() {
                            window.location.href = '/pegawai/' + $('#pegawai_id').val()
                        }, 1000);

                    }
                }
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
            })
        })

        function resetForm(is_success = false) {
<<<<<<< HEAD
            $('#tipe_alamat').removeClass('is-invalid');
            $('#error_tipe_alamat').text('')
            $('#propinsi_id').removeClass('is-invalid');
            $('#error_propinsi_id').text('');
            $('#kota_id').removeClass('is-invalid');
            $('#error_kota_id').text('')
            $('#kecamatan_id').removeClass('is-invalid');
            $('#error_kecamatan_id').text('');
            $('#desa_id').removeClass('is-invalid');
            $('#error_desa_id').text('');
            $('#kode_pos').removeClass('is-invalid');
            $('#error_kode_pos').text('');
            $('#alamat').removeClass('is-invalid');
            $('#error_alamat').text('');
        }
    </script>

    {{-- Limit Kode Pos --}}
    <script>
        function limitDigits(input, maxDigits) {
            let value = input.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
            let parts = value.split('.');
=======
            $('#error_tipe_alamat').text('')
            $('#error_propinsi_id').text('');
            $('#error_kota_id').text('')
            $('#error_kecamatan_id').text('');
            $('#error_desa_id').text('');
            $('#error_kode_pos').text('');
            $('#error_alamat').text('');
        }
        // {{-- Limit Kode Pos --}}

        function limitDigits(input, maxDigits) {
            const value = input.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
            const parts = value.split('.');
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964

            if (parts[0].length > maxDigits) {
                parts[0] = parts[0].slice(0, maxDigits);
            }

            if (parts[1] && parts[1].length > 2) { // Enforce a maximum of 2 decimal places
                parts[1] = parts[1].slice(0, 2);
            }

            input.value = parts.join('.');
        }
    </script>
<<<<<<< HEAD
=======
    <script>
        $('#pills-tab a').on('click', function(e) {
            e.preventDefault()
            const tab_id = this.getAttribute('id')
            if (tab_id == 'pills-diklat-tab') {
                url = "{{ route('diklat.datatable') }}"
                get_table_diklat(url)
                $(this).tab('show')
            }
        })
    </script>
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
@endpush
