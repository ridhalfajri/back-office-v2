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
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-regular-bpjs.index') }}">Pengajuan BPJS Regular</a>
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
                        action="{{ route('pengajuan-regular-bpjs.update', $bpjs->id) }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <p style="color: black">Lihat Kode dan Nama Faskes TK I: <a
                                        href="https://bit.ly/FaskesBPJS2020" target="_blank">Download
                                        File</a>
                                </p>
                                <p style="color: orange">Status Saat Ini: @if ($bpjs->status == 1)
                                        Pengajuan
                                    @elseif($bpjs->status == 2)
                                        Ditolak
                                    @elseif($bpjs->status == 3)
                                        Disetujui
                                    @else
                                        Tidak Diketahui
                                    @endif
                                </p>
                                <p style="color: red">Alasan Pengajuan Di Tolak: {{ $bpjs->keterangan_tolak }}
                                </p>

                                <div class="form-group @error('kode_hub_keluarga')has-error @enderror">
                                    <label>Status Keluarga <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="kode_hub_keluarga" name="kode_hub_keluarga" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if ($bpjs->kode_hub_keluarga == '1' || old('kode_hub_keluarga') == '1')
                                            <option value="1" selected>Peserta</option>
                                        @else
                                            <option value="1">Peserta</option>
                                        @endif

                                        @if ($bpjs->kode_hub_keluarga == '2' || old('kode_hub_keluarga') == '2')
                                            <option value="2" selected>Istri</option>
                                        @else
                                            <option value="2">Istri</option>
                                        @endif

                                        @if ($bpjs->kode_hub_keluarga == '3' || old('kode_hub_keluarga') == '3')
                                            <option value="3" selected>Suami</option>
                                        @else
                                            <option value="3">Suami</option>
                                        @endif

                                        @if ($bpjs->kode_hub_keluarga == '4' || old('kode_hub_keluarga') == '4')
                                            <option value="4" selected>Anak</option>
                                        @else
                                            <option value="4">Anak</option>
                                        @endif

                                    </select>
                                </div>

                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Nama <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama" id="nama"
                                        value="{{ old('nama') ?? $bpjs->nama }}" class="form-control" required=""
                                        maxlength="255" placeholder="Nama" autocomplete="off">
                                </div>

                                <div class="form-group @error('nik')has-error @enderror">
                                    <label>NIK <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nik" id="nik"
                                        value="{{ old('nik') ?? $bpjs->nik }}" class="form-control" required=""
                                        maxlength="50" placeholder="NIK" autocomplete="off">
                                </div>

                                <div class="form-group @error('no_kk')has-error @enderror">
                                    <label>No. KK <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_kk" id="no_kk"
                                        value="{{ old('no_kk') ?? $bpjs->no_kk }}" class="form-control" required=""
                                        maxlength="50" placeholder="No. KK" autocomplete="off">
                                </div>

                                <div class="form-group @error('tgl_lahir')has-error @enderror">
                                    <label>Tanggal Lahir <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') ?? $bpjs->tgl_lahir }}">
                                </div>

                                <div class="form-group @error('alamat')has-error @enderror">
                                    <label>Alamat <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="alamat" id="alamat"
                                        value="{{ old('alamat') ?? $bpjs->alamat }}" class="form-control" required=""
                                        placeholder="Alamat" autocomplete="off">
                                </div>

                            </div>
                            {{-- batas --}}
                            <div class="col-12 col-lg-6 col-md-6">
                                <p style="color: black; visibility: hidden;">hidden utk css
                                </p>
                                <p style="color: black; visibility: hidden;">hidden utk css
                                </p>
                                <p style="color: black; visibility: hidden;">hidden utk css
                                </p>

                                <div class="form-group @error('email')has-error @enderror">
                                    <label>Email <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email') ?? $bpjs->email }}" class="form-control" required=""
                                        maxlength="255" placeholder="Email" autocomplete="off">
                                </div>

                                <div class="form-group @error('no_telepon')has-error @enderror">
                                    <label>No. Telepon <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_telepon" id="no_telepon"
                                        value="{{ old('no_telepon') ?? $bpjs->no_telepon }}" class="form-control"
                                        required="" maxlength="50" placeholder="No. Telepon" autocomplete="off">
                                </div>

                                <div class="form-group @error('kode_faskes')has-error @enderror">
                                    <label>Kode Faskes TK I <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="kode_faskes" id="kode_faskes"
                                        value="{{ old('kode_faskes') ?? $bpjs->kode_faskes }}" class="form-control"
                                        required="" maxlength="50" placeholder="Kode Faskes" autocomplete="off">
                                </div>

                                <div class="form-group @error('nama_faskes')has-error @enderror">
                                    <label>Nama Faskes TK I <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama_faskes" id="nama_faskes"
                                        value="{{ old('nama_faskes') ?? $bpjs->nama_faskes }}" class="form-control"
                                        required="" maxlength="255" placeholder="Nama Faskes" autocomplete="off">
                                </div>

                                <div class="form-group @error('nama_ibu_kandung')has-error @enderror">
                                    <label>Nama Ibu Kandung <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama_ibu_kandung" id="nama_ibu_kandung"
                                        value="{{ old('nama_ibu_kandung') ?? $bpjs->nama_ibu_kandung }}"
                                        class="form-control" required="" maxlength="255"
                                        placeholder="Nama Ibu Kandung" autocomplete="off">
                                </div>

                                <div class="form-group @error('file_pengajuan_bpjs_regular')has-error @enderror">
                                    <label>Upload File Pengajuan BPJS Regular <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_pengajuan_bpjs_regular"
                                        name="file_pengajuan_bpjs_regular">
                                    @if ($bpjs->file_pengajuan_bpjs_regular)
                                        <a href="{{ $bpjs->file_pengajuan_bpjs_regular }}" target="_blank">Download</a>
                                        <br>
                                    @endif
                                    <br>
                                    <em style="color: black">Silakan upload file pengajuan bpjs (rar/zip max 50Mb)</em>
                                    <br>
                                    <em style="color: red">Format nama file:
                                        Pengajuan-BPJS-Regular-(STATUS KELUARGA)_(NAMA)_(NIP)_(UNIT KERJA)</em>
                                    <br>
                                    <br>
                                    <em style="color: black">Untuk Pengajuan Anak: file yang di-upload (1. KK, 2. Akte
                                        Lahir)</em>
                                    <br>
                                    <em style="color: black">Untuk Pengajuan Istri: file yang di-upload (1. KK, 2.
                                        Surat Nikah)
                                    </em>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('pengajuan-regular-bpjs.index') }}">
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
        $('#kode_hub_keluarga').select2({
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
