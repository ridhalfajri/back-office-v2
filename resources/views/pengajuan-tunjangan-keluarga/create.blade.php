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
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-tunjangan-keluarga.index') }}">Pengajuan Tunjangan
                    Keluarga</a>
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
                        action="{{ route('pengajuan-tunjangan-keluarga.store') }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <p style="color: red">Pengajuan Tunjangan Keluarga Lain: Istri/Suami, Anak.</p>
                                <p style="color: black">Lihat dokumen yang harus diisi untuk pengajuan istri/suami: <a
                                        href="{{ asset('assets/Form_Isian_KP4_Istri-Suami.zip') }}" target="_blank">Download
                                        File</a>
                                </p>
                                <p style="color: black">Lihat dokumen yang harus diisi untuk pengajuan anak: <a
                                        href="{{ asset('assets/Form_Isian_KP4_Anak.zip') }}" target="_blank">Download
                                        File</a>
                                </p>
                                <br>
                                <p style="color: brown">Untuk Pengajuan Istri/Suami: file yang di-upload (1. Nodin
                                    Permohonan dari Unit Kerja, 2. Form Tunjangan Keluarga (KP4), 3. Laporan Perkawinan
                                    Pertama, 4. Daftar Isian Keluarga, 5. KK, 6. Surat/Akta Nikah, 7. KTP Istri/Suami,
                                    8. Pas Foto Suami/Istri)</p>
                                <p style="color: brown">Untuk Pengajuan Anak: file yang di-upload (1. Nodin
                                    Permohonan dari Unit Kerja, 2. Form Tunjangan Keluarga (KP4), 3. Daftar Isian
                                    Keluarga, 4. KK, 5. Surat/Akta Nikah, 6. Akta Kelahiran Anak)
                                </p>

                                <div class="form-group @error('status_keluarga')has-error @enderror">
                                    <label>Status Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="status_keluarga" name="status_keluarga" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if (old('status_keluarga') == 'Istri')
                                            <option value="Istri" selected>Istri</option>
                                        @else
                                            <option value="Istri">Istri</option>
                                        @endif

                                        @if (old('status_keluarga') == 'Suami')
                                            <option value="Suami" selected>Suami</option>
                                        @else
                                            <option value="Suami">Suami</option>
                                        @endif

                                        @if (old('status_keluarga') == 'Anak')
                                            <option value="Anak" selected>Anak</option>
                                        @else
                                            <option value="Anak">Anak</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Nama Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                        class="form-control" required="" maxlength="255" placeholder="Nama"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('nik')has-error @enderror">
                                    <label>NIK Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                        class="form-control" required="" ide maxlength="50" placeholder="NIK"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('no_kk')has-error @enderror">
                                    <label>No. KK Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk') }}"
                                        class="form-control" required="" maxlength="50" placeholder="No. KK"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('tgl_lahir')has-error @enderror">
                                    <label>Tanggal Lahir Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                                </div>

                                <div class="form-group @error('tgl_perkawinan')has-error @enderror">
                                    <label>Tanggal Perkawinan (Jika Memilih Istri/Suami) <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tgl_perkawinan" name="tgl_perkawinan" value="{{ old('tgl_perkawinan') }}">
                                </div>

                                <div class="form-group @error('file_pengajuan_kp')has-error @enderror">
                                    <label>Upload File Pengajuan Tunjangan Keluarga <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_pengajuan_kp"
                                        name="file_pengajuan_kp">

                                    <em style="color: black">Silakan upload file pengajuan tunjangan (rar/zip max
                                        50Mb)</em>
                                    <br>
                                    <em style="color: red">Format nama file:
                                        Pengajuan-Tunjangan-Keluarga_(STATUS KELUARGA)_(NAMA)_(NIP)_(UNIT KERJA)</em>
                                    <br>
                                    <br>
                                    <em style="color: red">Note: 'File Form Tunjangan Keluarga (KP4), Laporan
                                        Perkawinan
                                        Pertama, dan Daftar Isian Keluarga yg sudah di-download dan diisi',
                                        dimasukkan ke
                                        file
                                        rar/zip
                                        dalam bentuk '.doc/.docx' (bukan .pdf atau yg lain)</em>

                                </div>

                            </div>

                        </div>

                        <a href="{{ route('pengajuan-tunjangan-keluarga.index') }}">
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
