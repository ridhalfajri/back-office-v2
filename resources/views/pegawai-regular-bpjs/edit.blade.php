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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-regular-bpjs.index') }}">Persetujuan BPJS
                    Regular</a>
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
                        action="{{ route('pegawai-regular-bpjs.update', $bpjs->id) }}" accept-charset="utf-8"
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

                                <div class="form-group @error('kode_hub_keluarga')has-error @enderror">
                                    <label>Status Keluarga </label>
                                    <input type="text" name="kode_hub_keluarga" id="kode_hub_keluarga"
                                        value="@if ($bpjs->kode_hub_keluarga == 1) Peserta
                                               @elseif($bpjs->kode_hub_keluarga == 2) Istri
                                               @elseif($bpjs->kode_hub_keluarga == 3) Suami
                                               @elseif($bpjs->kode_hub_keluarga == 4) Anak
                                               @else Tidak Diketahui @endif"
                                        disabled class="form-control" required="" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Nama </label>
                                    <input type="text" name="nama" id="nama"
                                        value="{{ old('nama') ?? $bpjs->nama }}" disabled class="form-control"
                                        required="" maxlength="255" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('nik')has-error @enderror">
                                    <label>NIK </label>
                                    <input type="text" name="nik" id="nik"
                                        value="{{ old('nik') ?? $bpjs->nik }}" disabled class="form-control" required=""
                                        maxlength="50" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('no_kk')has-error @enderror">
                                    <label>No. KK </label>
                                    <input type="text" name="no_kk" id="no_kk"
                                        value="{{ old('no_kk') ?? $bpjs->no_kk }}" disabled class="form-control"
                                        required="" maxlength="50" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('tgl_lahir')has-error @enderror">
                                    <label>Tanggal Lahir </label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        disabled id="tgl_lahir" name="tgl_lahir"
                                        value="{{ old('tgl_lahir') ?? $bpjs->tgl_lahir }}">
                                </div>

                                <div class="form-group @error('alamat')has-error @enderror">
                                    <label>Alamat Lengkap </label>
                                    <input type="text" name="alamat" id="alamat"
                                        value="{{ old('alamat') ?? $bpjs->alamat }}" disabled class="form-control"
                                        required="" placeholder="" autocomplete="off">
                                </div>

                                <div class="form-group @error('keterangan_tolak')has-error @enderror">
                                    <label>Keterangan Ditolak <span class="text-danger"><sup></sup></span></label>
                                    <input type="text" name="keterangan_tolak" id="keterangan_tolak"
                                        value="{{ old('keterangan_tolak') ?? $bpjs->keterangan_tolak }}"
                                        class="form-control" maxlength="255" placeholder="Keterangan ditolak"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('email')has-error @enderror">
                                    <label>Email </label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email') ?? $bpjs->email }}" class="form-control" required=""
                                        disabled maxlength="255" placeholder="Email" autocomplete="off">
                                </div>

                                <div class="form-group @error('no_telepon')has-error @enderror">
                                    <label>No. Telepon </label>
                                    <input type="text" name="no_telepon" id="no_telepon"
                                        value="{{ old('no_telepon') ?? $bpjs->no_telepon }}" class="form-control"
                                        disabled required="" maxlength="50" placeholder="No. Telepon"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('kode_faskes')has-error @enderror">
                                    <label>Kode Faskes TK I </label>
                                    <input type="text" name="kode_faskes" id="kode_faskes"
                                        value="{{ old('kode_faskes') ?? $bpjs->kode_faskes }}" class="form-control"
                                        disabled required="" maxlength="50" placeholder="Kode Faskes"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('nama_faskes')has-error @enderror">
                                    <label>Nama Faskes TK I </label>
                                    <input type="text" name="nama_faskes" id="nama_faskes"
                                        value="{{ old('nama_faskes') ?? $bpjs->nama_faskes }}" class="form-control"
                                        disabled required="" maxlength="255" placeholder="Nama Faskes"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('nama_ibu_kandung')has-error @enderror">
                                    <label>Nama Ibu Kandung </label>
                                    <input type="text" name="nama_ibu_kandung" id="nama_ibu_kandung"
                                        value="{{ old('nama_ibu_kandung') ?? $bpjs->nama_ibu_kandung }}" disabled
                                        class="form-control" required="" maxlength="255"
                                        placeholder="Nama Ibu Kandung" autocomplete="off">
                                </div>

                                {{-- file_kartu_bpjs  --}}
                                <div class="form-group @error('file_pengajuan_bpjs_regular')has-error @enderror">
                                    <label>File Pengajuan BPJS Regular: </label>
                                    {{-- <input class="form-control fileClass" type="file" id="file_kartu_bpjs"
                                        name="file_kartu_bpjs">
                                    <em>Silakan upload file kartu BPJS (pdf/doc/docx/rar/zip max 20Mb)</em>
                                    <br> --}}
                                    @if ($bpjs->file_pengajuan_bpjs_regular)
                                        <a href="{{ $bpjs->file_pengajuan_bpjs_regular }}" target="_blank">Download File
                                            Pengajuan</a>
                                    @endif
                                    <input type="text" style="visibility: hidden" disabled class="form-control"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('status')has-error @enderror">
                                    <label>Status Saat Ini </label>
                                    <input type="text" name="status" id="status"
                                        value="@if ($bpjs->status == 1) Pengajuan
                                               @elseif($bpjs->status == 2) Ditolak
                                               @elseif($bpjs->status == 3) Disetujui
                                               @else Tidak Diketahui @endif"
                                        disabled class="form-control" required="" maxlength="50" placeholder=""
                                        autocomplete="off">
                                </div>

                            </div>

                        </div>

                        <a href="{{ route('pegawai-regular-bpjs.index') }}">
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                Kembali
                            </button>
                        </a>

                        @if ($bpjs->daftar_ke_bpjs == 'N')
                            <button type="submit" id="setuju-btn"
                                class="btn btn-primary btn-sm waves-effect waves-light">
                                <i class="fa fa-check text-white"></i> Setujui
                            </button>
                            <button type="submit" id="tolak-btn"
                                class="btn btn-secondary btn-sm waves-effect waves-light">
                                <i class="fa fa-close text-white"></i> Tolak
                            </button>
                        @endif
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
