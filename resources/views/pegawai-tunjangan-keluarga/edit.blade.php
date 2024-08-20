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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-tunjangan-keluarga.index') }}">Persetujuan Tunjangan
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
                        action="{{ route('pegawai-tunjangan-keluarga.update', $ptk->id) }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('pegawai')has-error @enderror">
                                    <label>Pegawai </label>
                                    <input type="text" name="pegawai" id="pegawai"
                                        value="{{ $pegawai->nama_depan . ' ' . $pegawai->nama_belakang . ' - ' . $pegawai->nip . ' - ' . $pegawai->singkatan_unit_kerja }}"
                                        class="form-control" required="" placeholder="Pegawai" disabled
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('status_keluarga')has-error @enderror">
                                    <label>Status Keluarga </label>
                                    <input type="text" name="status_keluarga" id="status_keluarga"
                                        value="{{ old('status_keluarga') ?? $ptk->status_keluarga }}" disabled
                                        class="form-control" required="" maxlength="50" placeholder=""
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Nama Keluarga </label>
                                    <input type="text" name="nama" id="nama"
                                        value="{{ old('nama') ?? $ptk->nama }}" disabled class="form-control"
                                        required="" maxlength="255" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('nik')has-error @enderror">
                                    <label>NIK Keluarga </label>
                                    <input type="text" name="nik" id="nik"
                                        value="{{ old('nik') ?? $ptk->nik }}" disabled class="form-control" required=""
                                        maxlength="50" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('no_kk')has-error @enderror">
                                    <label>No. KK Keluarga </label>
                                    <input type="text" name="no_kk" id="no_kk"
                                        value="{{ old('no_kk') ?? $ptk->no_kk }}" disabled class="form-control"
                                        required="" maxlength="50" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('tgl_lahir')has-error @enderror">
                                    <label>Tanggal Lahir Keluarga </label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        disabled id="tgl_lahir" name="tgl_lahir"
                                        value="{{ old('tgl_lahir') ?? $ptk->tgl_lahir }}">
                                </div>

                                @if ($ptk->status_keluarga != 'Anak')
                                    <div class="form-group @error('tgl_perkawinan')has-error @enderror">
                                        <label>Tanggal Perkawinan (Jika Memilih Istri/Suami) </label>
                                        <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                            disabled id="tgl_perkawinan" name="tgl_perkawinan"
                                            value="{{ old('tgl_perkawinan') ?? $ptk->tgl_perkawinan }}">
                                    </div>
                                @endif

                                <div class="form-group @error('file_pengajuan_kp')has-error @enderror">
                                    <label>File Pengajuan Tunjangan Keluarga </label>
                                    {{-- <input class="form-control fileClass" type="file" id="file_kartu_bpjs"
                                        name="file_kartu_bpjs">
                                    <em>Silakan upload file kartu BPJS (pdf/doc/docx/rar/zip max 20Mb)</em>
                                    <br> --}}
                                    <br>
                                    @if ($ptk->file_pengajuan_kp)
                                        <a href="{{ $ptk->file_pengajuan_kp }}" target="_blank">Download File
                                            Pengajuan KP4</a>
                                    @endif
                                </div>

                                <div class="form-group @error('status')has-error @enderror">
                                    <label>Status Saat Ini </label>
                                    <input type="text" name="status" id="status"
                                        value="@if ($ptk->status == 1) Pengajuan
                                               @elseif($ptk->status == 2) Ditolak
                                               @elseif($ptk->status == 3) Disetujui
                                               @else Tidak Diketahui @endif"
                                        disabled class="form-control" required="" maxlength="50" placeholder=""
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('keterangan_tolak')has-error @enderror">
                                    <label>Keterangan Ditolak <span class="text-danger"><sup></sup></span></label>
                                    <input type="text" name="keterangan_tolak" id="keterangan_tolak"
                                        value="{{ old('keterangan_tolak') ?? $ptk->keterangan_tolak }}"
                                        class="form-control" maxlength="255" placeholder="Keterangan ditolak"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('file_kp_ttd')has-error @enderror">
                                    <label>Upload File KP4 yang Di-TTD (Jika Memilih Setujui) </label>
                                    <input class="form-control fileClass" type="file" id="file_kp_ttd"
                                        name="file_kp_ttd">

                                    @if ($ptk->file_kp_ttd)
                                        <a href="{{ $ptk->file_kp_ttd }}" target="_blank">Download</a>
                                        <br>
                                    @endif
                                    <br>
                                    <em style="color: black">Silakan upload file kp4 yang di-ttd (pdf max
                                        20Mb)</em>
                                    <br>
                                    <em style="color: red">Format nama file:
                                        File-KP4-TTD_(STATUS KELUARGA)_(NAMA)_(NIP)_(UNIT KERJA)</em>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('pegawai-tunjangan-keluarga.index') }}">
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                Kembali
                            </button>
                        </a>

                        <button type="submit" id="setuju-btn" class="btn btn-primary btn-sm waves-effect waves-light">
                            <i class="fa fa-check text-white"></i> Setujui
                        </button>
                        <button type="submit" id="tolak-btn" class="btn btn-secondary btn-sm waves-effect waves-light">
                            <i class="fa fa-close text-white"></i> Tolak
                        </button>

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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-pbl');
            const tolakBtn = document.getElementById('tolak-btn');
            const setujuBtn = document.getElementById('setuju-btn');

            tolakBtn.addEventListener('click', function() {
                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = 'button_clicked';
                hiddenField.value = 'tolak';
                form.appendChild(hiddenField);
            });

            setujuBtn.addEventListener('click', function() {
                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = 'button_clicked';
                hiddenField.value = 'setuju';
                form.appendChild(hiddenField);
            });
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
                                text: 'Apakah anda yakin?',
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
                                    swal('Informasi', 'Dibatalkan',
                                        'error');
                                    event.stopPropagation()
                                }
                            });
                        }
                    }, false)
                });
        })();
    </script>
@endpush
