@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
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
                            <a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-alamat-tab" data-toggle="pill" href="#pills-alamat"
                                role="tab" aria-controls="pills-alamat" aria-selected="true">Alamat</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                                <input type="text" class="form-control" disabled="" placeholder="NPWP"
                                                    value="{{ $pegawai->npwp }}">
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
                        @include('pegawai.pegawai-alamat')
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
    <!-- Modal -->
    <div class="modal fade" id="modal-alamat" tabindex="-1" role="dialog" aria-labelledby="modalAlamatLabel"
        aria-hidden="true">
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
                                <div class="form-group">
                                    <label class="form-label">Tipe Alamat</label>
                                    <select id="tipe_alamat" class="form-control custom-select">
                                        <option value="Asal">Asal</option>
                                        <option value="Domisili">Domisili</option>
                                    </select>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Propinsi</label>
                                    <select id="propinsi_id" name="propinsi_id"
                                        class="select-filter multiselect multiselect-custom">
                                    </select>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Kota</label>
                                    <select id="kota_id" name="kota_id"
                                        class="select-filter multiselect multiselect-custom">
                                        @foreach ($propinsi as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Kecamatan</label>
                                    <select id="kecamatan_id" name="kecamatan_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option value="bootstrap">Bootstrap</option>
                                        <option value="bootstrap-marketplace">Bootstrap Marketplace</option>
                                        <option value="bootstrap-theme">Bootstrap Theme</option>
                                        <option value="html">HTML</option>
                                        <option value="html-template">HTML Template</option>
                                        <option value="wp-marketplace">WordPress Marketplace</option>
                                        <option value="wp-plugin">WordPress Plugin</option>
                                        <option value="wp-theme">WordPress Theme</option>
                                    </select>
                                </div>
                                <div class="form-group multiselect_div">
                                    <label class="form-label">Desa</label>
                                    <select id="desa_id" name="desa_id"
                                        class="select-filter multiselect multiselect-custom">
                                        <option value="bootstrap">Bootstrap</option>
                                        <option value="bootstrap-marketplace">Bootstrap Marketplace</option>
                                        <option value="bootstrap-theme">Bootstrap Theme</option>
                                        <option value="html">HTML</option>
                                        <option value="html-template">HTML Template</option>
                                        <option value="wp-marketplace">WordPress Marketplace</option>
                                        <option value="wp-plugin">WordPress Plugin</option>
                                        <option value="wp-theme">WordPress Theme</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="number" id="kode_pos" min="0" step="0.01"
                                        oninput="limitDigits(this, 5);" class="form-control mt-3 state-valid"
                                        value="" placeholder="Kode Pos">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea id="alamat" rows="3" class="form-control" placeholder="Alamat Lengkap"></textarea>
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
@endsection
@push('script')
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script>
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $(function() {
            select_propinsi();
        })
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
                },
                success: function(response) {}
            })
        })

        function resetForm(is_success = false) {
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


                }
            })
        }
    </script>

    {{-- Limit Kode Pos --}}
    <script>
        function limitDigits(input, maxDigits) {
            let value = input.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
            let parts = value.split('.');

            if (parts[0].length > maxDigits) {
                parts[0] = parts[0].slice(0, maxDigits);
            }

            if (parts[1] && parts[1].length > 2) { // Enforce a maximum of 2 decimal places
                parts[1] = parts[1].slice(0, 2);
            }

            input.value = parts.join('.');
        }
    </script>
@endpush
