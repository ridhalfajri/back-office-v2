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

                    <form class="needs-validation" id="form-pbl" method="post"
                        action="{{ route('pengajuan-tambahan-bpjs.store') }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <p style="color: red">Pengajuan Anggota Keluarga Lain: Anak (ke-4 dst), Orang Tua, atau
                                    Mertua.</p>
                                <p style="color: black">Lihat Surat Kuasa: <a
                                        href="{{ asset('assets/Surat_Kuasa_BPJS_Keluarga_Lain.doc') }}"
                                        target="_blank">Download
                                        File</a>
                                </p>

                                <div class="form-group @error('status_keluarga')has-error @enderror">
                                    <label>Status Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="status_keluarga" name="status_keluarga" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if (old('status_keluarga') == 'Anak')
                                            <option value="Anak" selected>Anak</option>
                                        @else
                                            <option value="Anak">Anak</option>
                                        @endif

                                        @if (old('status_keluarga') == 'Orang Tua')
                                            <option value="Orang Tua" selected>Orang Tua</option>
                                        @else
                                            <option value="Orang Tua">Orang Tua</option>
                                        @endif

                                        @if (old('status_keluarga') == 'Mertua')
                                            <option value="Mertua" selected>Mertua</option>
                                        @else
                                            <option value="Mertua">Mertua</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('nama_keluarga')has-error @enderror">
                                    <label>Nama Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama_keluarga" id="nama_keluarga"
                                        value="{{ old('nama_keluarga') }}" class="form-control" required=""
                                        maxlength="255" placeholder="Nama Keluarga" autocomplete="off">
                                </div>

                                <div class="form-group @error('nik_keluarga')has-error @enderror">
                                    <label>NIK Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nik_keluarga" id="nik_keluarga"
                                        value="{{ old('nik_keluarga') }}" class="form-control" required="" ide
                                        maxlength="50" placeholder="NIK Keluarga" autocomplete="off">
                                </div>

                                <div class="form-group @error('no_kk_keluarga')has-error @enderror">
                                    <label>No. KK Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_kk_keluarga" id="no_kk_keluarga"
                                        value="{{ old('no_kk_keluarga') }}" class="form-control" required=""
                                        maxlength="50" placeholder="No. KK Keluarga" autocomplete="off">
                                </div>

                                {{-- <div class="form-group @error('total_orang_tua')has-error @enderror">
                                    <label>Total Orang Tua <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_orang_tua" id="total_orang_tua"
                                        value="{{ old('total_orang_tua') }}" class="form-control" required=""
                                        maxlength="100" placeholder="Total orang tua" autocomplete="off">
                                </div>

                                <div class="form-group @error('total_mertua')has-error @enderror">
                                    <label>Total Mertua <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_mertua" id="total_mertua"
                                        value="{{ old('total_mertua') }}" class="form-control" required=""
                                        maxlength="100" placeholder="Total mertua" autocomplete="off">
                                </div>

                                <div class="form-group @error('total_kelebihan_anak')has-error @enderror">
                                    <label>Total Anak <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_kelebihan_anak" id="total_kelebihan_anak"
                                        value="{{ old('total_kelebihan_anak') }}" class="form-control" required=""
                                        maxlength="100" placeholder="Total anak" autocomplete="off">
                                </div> --}}

                                {{-- <div class="form-group @error('keterangan_orang_tua')has-error @enderror">
                                    <label>Keterangan Orang Tua <span class="text-danger"><sup>*</sup></span></label>
                                    <textarea name="keterangan_orang_tua" id="keterangan_orang_tua" rows="2"
                                        class="form-control form-control-plaintext"
                                        placeholder="Keterangan data orang tua (no kk, nik, nama, ttl, no hp, email)" autocomplete="off">{{ old('keterangan_orang_tua') }}</textarea>
                                </div>

                                <div class="form-group @error('keterangan_mertua')has-error @enderror">
                                    <label>Keterangan Mertua <span class="text-danger"><sup>*</sup></span></label>
                                    <textarea name="keterangan_mertua" id="keterangan_mertua" rows="2" class="form-control form-control-plaintext"
                                        placeholder="Keterangan data mertua (no kk, nik, nama, ttl, no hp, email)" autocomplete="off">{{ old('keterangan_mertua') }}</textarea>
                                </div>

                                <div class="form-group @error('keterangan_kelebihan_anak')has-error @enderror">
                                    <label>Keterangan Anak <span class="text-danger"><sup>*</sup></span></label>
                                    <textarea name="keterangan_kelebihan_anak" id="keterangan_kelebihan_anak" rows="2"
                                        class="form-control form-control-plaintext" placeholder="Keterangan data anak (no kk, nik, nama, ttl, no hp, email)"
                                        autocomplete="off">{{ old('keterangan_kelebihan_anak') }}</textarea>
                                </div> --}}

                                <div class="form-group @error('file_pengajuan_bpjs')has-error @enderror">
                                    <label>Upload File Pengajuan BPJS Keluarga Lain <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_pengajuan_bpjs"
                                        name="file_pengajuan_bpjs">

                                    <em style="color: black">Silakan upload file pengajuan bpjs (rar/zip max 50Mb)</em>
                                    <br>
                                    <em style="color: red">Format nama file:
                                        Pengajuan-BPJS-Keluarga-Lain-(STATUS KELUARGA)_(NAMA)_(NIP)_(UNIT KERJA)</em>
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
