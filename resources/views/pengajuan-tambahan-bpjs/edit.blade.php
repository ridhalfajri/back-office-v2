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
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-tambahan-bpjs.index') }}">Pengajuan BPJS Keluarga
                    Lain</a>
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
                        action="{{ route('pengajuan-tambahan-bpjs.update', $bpjs->id) }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <p style="color: black">Lihat Surat Kuasa: <a
                                        href="{{ asset('assets/Surat_Kuasa_BPJS_Keluarga_Lain.doc') }}"
                                        target="_blank">Download
                                        File</a>
                                </p>
                                <p style="color: orange">Status Saat Ini: @if ($bpjs->status == 1)
                                        Pengajuan
                                    @elseif($bpjs->status == 2)
                                        Ditolak
                                    @elseif($bpjs->status == 3)
                                        Disetujui
                                    @elseif($bpjs->status == 4)
                                        Daftar Ke BPJS
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </p>
                                <p style="color: red">Alasan Pengajuan Di Tolak: {{ $bpjs->keterangan_tolak }}
                                </p>

                                <div class="form-group @error('status_keluarga')has-error @enderror">
                                    <label>Status Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="status_keluarga" name="status_keluarga" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if ($bpjs->status_keluarga == 'Anak' || old('status_keluarga') == 'Anak')
                                            <option value="Anak" selected>Anak</option>
                                        @else
                                            <option value="Anak">Anak</option>
                                        @endif

                                        @if ($bpjs->status_keluarga == 'Orang Tua' || old('status_keluarga') == 'Orang Tua')
                                            <option value="Orang Tua" selected>Orang Tua</option>
                                        @else
                                            <option value="Orang Tua">Orang Tua</option>
                                        @endif

                                        @if ($bpjs->status_keluarga == 'Mertua' || old('status_keluarga') == 'Mertua')
                                            <option value="Mertua" selected>Mertua</option>
                                        @else
                                            <option value="Mertua">Mertua</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('nama_keluarga')has-error @enderror">
                                    <label>Nama Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama_keluarga" id="nama_keluarga"
                                        value="{{ old('nama_keluarga') ?? $bpjs->nama_keluarga }}" class="form-control"
                                        required="" maxlength="255" placeholder="Nama Keluarga" autocomplete="off">
                                </div>

                                <div class="form-group @error('nik_keluarga')has-error @enderror">
                                    <label>NIK Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nik_keluarga" id="nik_keluarga"
                                        value="{{ old('nik_keluarga') ?? $bpjs->nik_keluarga }}" class="form-control"
                                        required="" maxlength="50" placeholder="NIK Keluarga" autocomplete="off">
                                </div>

                                <div class="form-group @error('no_kk_keluarga')has-error @enderror">
                                    <label>KK Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_kk_keluarga" id="no_kk_keluarga"
                                        value="{{ old('no_kk_keluarga') ?? $bpjs->no_kk_keluarga }}" class="form-control"
                                        required="" maxlength="50" placeholder="KK Keluarga" autocomplete="off">
                                </div>

                                <div class="form-group @error('file_pengajuan_bpjs')has-error @enderror">
                                    <label>Upload File Pengajuan BPJS Keluarga Lain <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_pengajuan_bpjs"
                                        name="file_pengajuan_bpjs">

                                    @if ($bpjs->file_pengajuan_bpjs)
                                        <a href="{{ $bpjs->file_pengajuan_bpjs }}" target="_blank">Download</a>
                                        <br>
                                    @endif
                                    <br>
                                    <em style="color: black">Silakan upload file pengajuan bpjs (rar/zip max 50Mb)</em>
                                    <br>
                                    <em style="color: red">Format nama file:
                                        Pengajuan-BPJS-Keluarga-Lain(STATUS KELUARGA)_(NAMA)_(NIP)_(UNIT KERJA)</em>
                                    <br>
                                    <br>
                                    <em style="color: black">Untuk Pengajuan Anak: file yang di-upload (1. Surat Kuasa, 2.
                                        KK, 3. Akte
                                        Lahir)</em>
                                    <br>
                                    <em style="color: black">Untuk Pengajuan Orang Tua/Mertua: file yang di-upload (1. Surat
                                        Kuasa, 2. KK, 3.
                                        KTP)
                                    </em>
                                    <br>
                                    <br>
                                    <em style="color: red">Note: Tambahan 1 orang anggota keluarga lain akan ada potongan 1%
                                        dari THP</em>
                                </div>

                            </div>
                        </div>

                        <a href="{{ route('pengajuan-tambahan-bpjs.index') }}">
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
        $('#status_keluarga').select2({
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
