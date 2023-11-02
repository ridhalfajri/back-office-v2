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
                                aria-controls="pills-alamat" aria-selected="true" onclick="get_data_alamat">Alamat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-diklat-tab" data-toggle="pill" href="#pills-diklat" role="tab"
                                aria-controls="pills-diklat" aria-selected="true">Diklat</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
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
                                            <input type="hidden" id="pegawai_id" class="form-control" disabled=""
                                                placeholder="Id" value="{{ $pegawai->id }}">
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
@endsection
@push('modal')
    <!-- Modal -->
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
@endpush
@push('script')
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script>
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $('#modal-alamat').on('show.bs.modal', function(e) {
            resetForm()
            $('#modal-alamat').modal('show')

        })
        const domisili = function() {
            get_data_alamat('Domisili')
        }
        const asal = function() {
            get_data_alamat('Asal')
        }
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
                        select_propinsi()
                        $('#tipe_alamat').val(tipe_alamat)
                    } else {
                        set_data_edit(response)
                    }
                }
            })
        }
        const set_data_edit = (response) => {
            select_propinsi(response.result.propinsi_id)
            select_kota(response.result.propinsi_id, response.result.kota_id)
            select_kecamatan(response.result.kota_id, response.result.kecamatan_id)
            select_desa(response.result.kecamatan_id, response.result.desa_id)
            $('#tipe_alamat').val(response.result.tipe_alamat)
            $('#kode_pos').val(response.result.kode_pos)
            $('#alamat').val(response.result.alamat)
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                            location.reload();
                        }, 1000);
                    }
                }
            })
        })

        function resetForm(is_success = false) {
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
                let tbl_diklat;
                tbl_diklat = $("#tbl-diklat").DataTable({
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
                        url: "{{ route('diklat.datatable') }}",
                        type: "POST",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
                        },
                        data: {
                            pegawai_id: $("#pegawai_id").val(),
                        },
                    },
                    columns: [{
                            data: "no",
                            name: "no",
                            class: "text-center",
                        },
                        {
                            data: "nama",
                            name: "nama",
                        },
                        {
                            data: "tanggal_mulai",
                            name: "tanggal_mulai",
                        },
                        {
                            data: "penyelenggaran",
                            name: "penyelenggaran",
                        },
                        {
                            data: "aksi",
                            name: "aksi",
                            class: "text-center actions",
                        },
                    ],
                    columnDefs: [{
                        sortable: false,
                        searchable: false,
                        targets: [0, -1],
                    }, ],
                    order: [
                        [1, "asc"]
                    ],
                });

                tbl_diklat.on("draw.dt", function() {
                    var info = tbl_diklat.page.info();
                    tbl_diklat
                        .column(0, {
                            search: "applied",
                            order: "applied",
                            page: "applied",
                        })
                        .nodes()
                        .each(function(cell, i) {
                            cell.innerHTML = i + 1 + info.start;
                        });
                });
                $(this).tab('show')
            }
        })
    </script>
@endpush
