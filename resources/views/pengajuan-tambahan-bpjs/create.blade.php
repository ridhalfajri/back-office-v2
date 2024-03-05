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
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-tambahan-bpjs.index') }}">Pengajuan Tambahan BPJS</a>
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

                    <form class="needs-validation" id="form-pbl" method="post"
                        action="{{ route('pengajuan-tambahan-bpjs.store') }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('total_orang_tua')has-error @enderror">
                                    <label>Total Orang Tua <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_orang_tua" id="total_orang_tua" value="{{ old('total_orang_tua') }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total orang tua"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('total_mertua')has-error @enderror">
                                    <label>Total Mertua <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_mertua" id="total_mertua" value="{{ old('total_mertua') }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total mertua"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('total_kelebihan_anak')has-error @enderror">
                                    <label>Total Anak <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_kelebihan_anak" id="total_kelebihan_anak" value="{{ old('total_kelebihan_anak') }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total anak"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('keterangan_orang_tua')has-error @enderror">
                                    <label>Keterangan Orang Tua <span class="text-danger"><sup>*</sup></span></label>
                                    <textarea name="keterangan_orang_tua" id="keterangan_orang_tua" rows="2"
                                        class="form-control form-control-plaintext" placeholder="Keterangan data orang tua (no kk, nik, nama, ttl, no hp, email)"
                                        autocomplete="off">{{ old('keterangan_orang_tua') }}</textarea>
                                </div>

                                <div class="form-group @error('keterangan_mertua')has-error @enderror">
                                    <label>Keterangan Mertua <span class="text-danger"><sup>*</sup></span></label>
                                    <textarea name="keterangan_mertua" id="keterangan_mertua" rows="2"
                                        class="form-control form-control-plaintext" placeholder="Keterangan data mertua (no kk, nik, nama, ttl, no hp, email)"
                                        autocomplete="off">{{ old('keterangan_mertua') }}</textarea>
                                </div>

                                <div class="form-group @error('keterangan_kelebihan_anak')has-error @enderror">
                                    <label>Keterangan Anak <span class="text-danger"><sup>*</sup></span></label>
                                    <textarea name="keterangan_kelebihan_anak" id="keterangan_kelebihan_anak" rows="2"
                                        class="form-control form-control-plaintext" placeholder="Keterangan data anak (no kk, nik, nama, ttl, no hp, email)"
                                        autocomplete="off">{{ old('keterangan_kelebihan_anak') }}</textarea>
                                </div>

                                <div class="form-group @error('file_pengajuan_bpjs')has-error @enderror">
                                    <label>Upload File Pengajuan Tambahan BPJS <span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_pengajuan_bpjs"
                                        name="file_pengajuan_bpjs">
                                    <em>Silakan upload file pengajuan bpjs (rar/zip max 50Mb)</em>
                                    <br>
                                    <em>Format nama file: Pengajuan-BPJS-Tambahan_'nama'_'nip'_'unit kerja'</em>
                                    <br>
                                    <br>
                                    <em>Note: Tambahan 1 orang anggota keluarga lain akan ada potongan 1% dari THP</em>
                                </div>

                            </div>

                        </div>

                        <a href="{{ route('pengajuan-tambahan-bpjs.index') }}">
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                Kembali
                            </button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
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
                            // Konfirmasi sebelum menyimpan data
                            swal({
                                title: 'Konfirmasi!',
                                text: 'Apakah anda yakin ingin menyimpan data?',
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
                                    swal('Informasi', 'Simpan data dibatalkan', 'error');
                                    event.stopPropagation()
                                }
                            });
                        }
                    }, false)
                });
        })();
    </script>
@endpush
