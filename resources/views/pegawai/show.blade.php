@extends('template')
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
                            <a class="nav-link" id="pills-blog-tab" data-toggle="pill" href="#pills-blog" role="tab"
                                aria-controls="pills-blog" aria-selected="true">Blog</a>
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
                        <div class="tab-pane fade" id="pills-blog" role="tabpanel" aria-labelledby="pills-blog-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="new_post">
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        </div>
                                        <div class="mt-4 text-right">
                                            <button class="btn btn-warning"><i class="icon-link"></i></button>
                                            <button class="btn btn-warning"><i class="icon-camera"></i></button>
                                            <button class="btn btn-primary">Post</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card blog_single_post">
                                <div class="img-post">
                                    <img class="d-block img-fluid" src="../assets/images/gallery/6.jpg"
                                        alt="First slide">
                                </div>
                                <div class="card-body">
                                    <h4><a href="#">All photographs are accurate</a></h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at its layout. The point of using Lorem Ipsum is that
                                        it has a more-or-less normal</p>
                                </div>
                                <div class="footer">
                                    <div class="actions">
                                        <a href="javascript:void(0);" class="btn btn-outline-secondary">Continue
                                            Reading</a>
                                    </div>
                                    <ul class="stats list-unstyled">
                                        <li><a href="javascript:void(0);">General</a></li>
                                        <li><a href="javascript:void(0);" class="icon-heart"> 28</a></li>
                                        <li><a href="javascript:void(0);" class="icon-bubbles"> 128</a></li>
                                    </ul>
                                </div>
                                <ul class="list-group card-list-group">
                                    <li class="list-group-item py-5">
                                        <div class="media">
                                            <img class="media-object avatar avatar-md mr-4"
                                                src="../assets/images/xs/avatar3.jpg" alt="" />
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <small class="float-right text-muted">4 min</small>
                                                    <h5>Peter Richards</h5>
                                                </div>
                                                <div>
                                                    Aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula
                                                    porta felis euismod semper. Morbi leo risus, porta ac consectetur ac,
                                                    vestibulum at eros. Cras
                                                    justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id
                                                    ligula porta felis euismod semper. Cum sociis natoque penatibus et
                                                    magnis dis parturient montes,
                                                    nascetur ridiculus mus.
                                                </div>
                                                <ul class="media-list">
                                                    <li class="media mt-4">
                                                        <img class="media-object avatar mr-4"
                                                            src="../assets/images/xs/avatar1.jpg" alt="" />
                                                        <div class="media-body">
                                                            <strong>Debra Beck: </strong>
                                                            Donec id elit non mi porta gravida at eget metus. Vivamus
                                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
                                                            Donec ullamcorper nulla non metus
                                                            auctor fringilla. Praesent commodo cursus magna, vel scelerisque
                                                            nisl consectetur et. Sed posuere consectetur est at lobortis.
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card blog_single_post">
                                <div class="img-post">
                                    <img class="d-block img-fluid" src="../assets/images/gallery/4.jpg"
                                        alt="First slide">
                                </div>
                                <div class="card-body">
                                    <h4><a href="#">All photographs are accurate</a></h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at its layout. The point of using Lorem Ipsum is that
                                        it has a more-or-less normal</p>
                                </div>
                                <div class="footer">
                                    <div class="actions">
                                        <a href="javascript:void(0);" class="btn btn-outline-secondary">Continue
                                            Reading</a>
                                    </div>
                                    <ul class="stats list-unstyled">
                                        <li><a href="javascript:void(0);">General</a></li>
                                        <li><a href="javascript:void(0);" class="icon-heart"> 28</a></li>
                                        <li><a href="javascript:void(0);" class="icon-bubbles"> 128</a></li>
                                    </ul>
                                </div>
                                <ul class="list-group card-list-group">
                                    <li class="list-group-item py-5">
                                        <div class="media">
                                            <img class="media-object avatar avatar-md mr-4"
                                                src="../assets/images/xs/avatar7.jpg" alt="" />
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <small class="float-right text-muted">12 min</small>
                                                    <h5>Peter Richards</h5>
                                                </div>
                                                <div>
                                                    Donec id elit non mi porta gravida at eget metus. Integer posuere erat a
                                                    ante venenatis dapibus posuere velit aliquet. Cum sociis natoque
                                                    penatibus et magnis dis
                                                    parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet,
                                                    consectetur adipiscing elit.
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-5">
                                        <div class="media">
                                            <img class="media-object avatar avatar-md mr-4"
                                                src="../assets/images/xs/avatar6.jpg" alt="" />
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <small class="float-right text-muted">34 min</small>
                                                    <h5>Peter Richards</h5>
                                                </div>
                                                <div>
                                                    Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula
                                                    porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem
                                                    lacinia quam
                                                    venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod.
                                                    Donec sed odio dui.
                                                </div>
                                                <ul class="media-list">
                                                    <li class="media mt-4">
                                                        <img class="media-object avatar mr-4"
                                                            src="../assets/images/xs/avatar5.jpg" alt="" />
                                                        <div class="media-body">
                                                            <strong>Wayne Holland: </strong>
                                                            Donec id elit non mi porta gravida at eget metus. Vivamus
                                                            sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
                                                            Donec ullamcorper nulla non metus
                                                            auctor fringilla. Praesent commodo cursus magna, vel scelerisque
                                                            nisl consectetur et. Sed posuere consectetur est at lobortis.
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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
