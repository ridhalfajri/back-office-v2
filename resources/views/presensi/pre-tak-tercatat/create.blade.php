@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('pre-tak-tercatat.index') }}">Riwayat Presensi Tidak Tercatat</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="bg-white">
                    <div class="btn-group btn-breadcrumb">
                         <h3>Form Pengajuan Presensi Tidak Tercatat</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="student-info">

                    <form class="needs-validation" id="preTakTercatatForm" method="post"  action="{{ route('pre-tak-tercatat.store') }}" enctype="multipart/form-data" accept-charset="utf-8" novalidate>
                        @csrf

                        @php
                            $jabatan = '';
                            $unitkerja = '';
                        @endphp

                        @foreach ($pegawai as $data)
                            @if($data->is_plt == 1)
                                @if($jabatan == '')
                                    @php
                                        $jabatan = $data->nama_jabatan;
                                    @endphp
                                @else
                                    @php
                                        $jabatan = $jabatan . ' / '. $data->nama_jabatan;
                                    @endphp
                                @endif
                            @else
                                @if($jabatan == '')
                                    @php
                                        $jabatan = $data->nama_jabatan ;
                                    @endphp
                                @else
                                    @php
                                        $jabatan = $jabatan .' / '. $data->nama_jabatan;
                                    @endphp
                                @endif
                            @endif

                            @if($unitkerja == '')
                                    @php
                                        $unitkerja = $data->nama_unit_kerja;
                                    @endphp
                                @else
                                    @php
                                        $unitkerja = $unitkerja . ' / ' . $data->nama_unit_kerja;
                                    @endphp
                                @endif

                        @endforeach

                        @foreach ($pegawai as $data)

                            <div class="row rowdata">
                                <div class="col-sm-2">
                                    <strong>NIP</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $data->nip }}
                                </div>

                                <div class="col-sm-2">
                                    <strong>Pangkat</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $data->nama_pangkat }}
                                </div>
                            </div>

                            <div class="row rowdata">
                                <div class="col-sm-2">
                                    <strong>Nama Pegawai</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $data->nama_depan . ' ' . $data->nama_belakang }}
                                </div>

                                <div class="col-sm-2">
                                    <strong>Nama Golongan</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $data->nama_golongan }}
                                </div>
                            </div>

                            <div class="row rowdata">
                                <div class="col-sm-2">
                                    <strong>Tempat & Tanggal Lahir</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d/m/Y') }}
                                </div>

                                <div class="col-sm-2">
                                    <strong>Jenis Jabatan</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $data->jenis_jabatan }}
                                </div>

                            </div>

                            <div class="row rowdata">
                                <div class="col-sm-2">
                                    <strong>Unit Kerja</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $unitkerja  }}
                                </div>

                                <div class="col-sm-2">
                                    <strong>Nama Jabatan</strong>
                                </div>
                                <div class="col-sm-4">
                                    : {{ $jabatan }}
                                </div>
                            </div>

                            @break
                        @endforeach

                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <strong>Jenis Presensi <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('jenis') has-error @enderror">
                                    <select class="form-control btn" id="jenis" name="jenis" required>
                                        <option value="" selected disabled>Pilih Presensi</option>
                                        <option value="1" {{ old('jenis') == 1 ? 'selected' : '' }}> Jam Masuk</option>
                                        <option value="2" {{ old('jenis') == 2 ? 'selected' : '' }}> Jam Pulang</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan Pilih Jenis Presensi Yang Tidak Tercatat
                                    </div>
                                    @error('jenis')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <strong>Tanggal <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('tanggal_pengajuan') has-error @enderror">
                                    <input class="form-control" type="date" id="tanggal_pengajuan" name = "tanggal_pengajuan" value="{{ old('tanggal_pengajuan') }}" autocomplete="off" required/>
                                    @error('tanggal_pengajuan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <strong>Jam <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('jam_perubahan') has-error @enderror">
                                    <input class="form-control" type="time" id="jam_perubahan" name = "jam_perubahan" value="{{ old('jam_perubahan') }}" autocomplete="off" required/>
                                    @error('jam_perubahan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <strong>Unggah Tangkapan Layar Daftar Presensi <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('media_data_presensi') has-error @enderror">
                                    <input type="file" name="media_data_presensi" id="media_data_presensi" accept="image/*,.pdf, .doc, .docx" required>
                                    <div class="invalid-feedback">
                                        Silakan Upload File Yang Berisi Tangkapan Layar Daftar Presensi
                                    </div>
                                    @error('media_data_presensi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <strong>Unggah Tangkapan Layar Logbook<span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('media_presensi_logbook') has-error @enderror">
                                    <input type="file" name="media_presensi_logbook" id="media_presensi_logbook" accept="image/*,.pdf, .doc, .docx" required>
                                    <div class="invalid-feedback">
                                        Silakan Upload File Yang Berisi Tangkapan Layar Logbook
                                    </div>
                                    @error('media_presensi_logbook')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row rowdata">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-check-square" aria-hidden="true"></i> Simpan</button>
                    </form>

                </div>
            </div>

            <div class="card-body">
                <div class="card-content">

                </div>
                <!-- /.card-content -->
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2-4.0.13/dist/js/select2.min.js') }}"></script>
    <script>
        (function () {
          'use strict'

          var forms = document.querySelectorAll('.needs-validation')

          Array.prototype.slice.call(forms)
            .forEach(function (form) {
              form.addEventListener('submit', function (event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                  event.stopPropagation()
                  form.classList.add('was-validated')
                }else
                {
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

        $(document).ready(function() {
            $('#jenis').select2({
                width: '100%',
            });
        });
    </script>

@endpush

