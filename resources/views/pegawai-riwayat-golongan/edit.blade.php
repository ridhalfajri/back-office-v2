@extends('template')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('pegawai-riwayat-golongan.index') }}">Riwayat Golongan Pegawai</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="alert alert-warning">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form class="needs-validation" id="form-prg" method="post"
                        action="{{ route('pegawai-riwayat-golongan.update', $prg->id) }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('pegawai_id')has-error @enderror">

                                    <input type="hidden" name="pegawai_id"
                                        value="{{ $prg->pegawai_id ?? old('pegawai_id') }}">

                                    <label>Nama Pegawai <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="pegawai_id" class="form-control" disabled>
                                        <option value="">--Pilih--</option>
                                        @foreach ($pegawai as $item)
                                            @if ($prg->pegawai_id == $item->id || old('pegawai_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama_pegawai }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama_pegawai }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('golongan_id')has-error @enderror">
                                    <label>Golongan <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="golongan_id" name="golongan_id" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($golongan as $item)
                                            @if ($prg->golongan_id == $item->id || old('golongan_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('tmt_golongan')has-error @enderror">
                                    <label>TMT Golongan <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tmt_golongan" name="tmt_golongan"
                                        value="{{ old('tmt_golongan') ?? $prg->tmt_golongan }}">
                                </div>

                                <div class="form-group @error('no_sk')has-error @enderror">
                                    <label>No. SK <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_sk" id="no_sk"
                                        value="{{ old('no_sk') ?? $prg->no_sk }}" class="form-control" required=""
                                        maxlength="50" placeholder="No. SK" autocomplete="off">
                                </div>

                                <div class="form-group @error('tanggal_sk')has-error @enderror">
                                    <label>Tanggal SK <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tanggal_sk" name="tanggal_sk"
                                        value="{{ old('tanggal_sk') ?? $prg->tanggal_sk }}">
                                </div>

                                <div class="form-group @error('is_active')has-error @enderror">
                                    <label>Status <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="is_active" name="is_active" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if ($prg->is_active == '1' || old('is_active') == '1')
                                            <option value="1" selected>Aktif</option>
                                        @else
                                            <option value="1">Aktif</option>
                                        @endif

                                        @if ($prg->is_active == '0' || old('is_active') == '0')
                                            <option value="0" selected>Tidak Aktif</option>
                                        @else
                                            <option value="0">Tidak Aktif</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('sk_golongan')has-error @enderror">
                                    <label>Upload SK </label>
                                    <input class="form-control fileClass" type="file" id="sk_golongan"
                                        name="sk_golongan">
                                    <em>Silakan upload file SK (jpg/jpeg/png/pdf max 2Mb)</em>
                                    <br>
                                    @if ($prg->sk_golongan)
                                        <a href="{{ $prg->sk_golongan }}" target="_blank">Download</a>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <a href="{{ route('pegawai-riwayat-golongan.index') }}">
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                Kembali
                            </button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $('#golongan_id').select2({
            width: 'resolve'
        });

        $('#is_active').select2({
            width: 'resolve'
        });

        $('#pegawai_id').select2({
            width: 'resolve'
        });

        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault()
                        if (!form.checkValidity()) {
                            event.stopPropagation()
                            form.classList.add('was-validated')
                        } else {
                            // Konfirmasi sebelum mengubah data
                            swal({
                                title: 'Konfirmasi!',
                                text: 'Apakah anda yakin ingin mengubah data?',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#78c0ec',
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Tidak',
                                closeOnConfirm: true,
                                closeOnCancel: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    form.submit()
                                } else {
                                    swal('Informasi', 'Ubah data dibatalkan', 'error');
                                    event.stopPropagation()
                                }
                            });
                        }
                    }, false)
                });
        })();
    </script>
@endpush
