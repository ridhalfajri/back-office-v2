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
            <li class="breadcrumb-item"><a href="/presensi/pre-ijin">Riwayat Ijin Kehadiran</a></li>
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
                         <h3>Form Pengajuan Ijin</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="student-info">

                    <form class="needs-validation" id="preIjinForm" method="post"  action="{{ route('pre-ijin.store') }}"  accept-charset="utf-8" novalidate>
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
                                <strong>Jenis Ijin  <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('jenis_ijin') has-error @enderror">
                                    <select class="form-control btn" id="jenis_ijin" name="jenis_ijin" required>
                                        <option value="" selected disabled>Pilih Jenis Ijin</option>
                                        <option value="1" {{ old('jenis_ijin') == 1 ? 'selected' : '' }}> Ijin Datang Terlambat</option>
                                        <option value="2" {{ old('jenis_ijin') == 2 ? 'selected' : '' }}> Ijin Pulang Awal</option>
                                        <option value="3" {{ old('jenis_ijin') == 3 ? 'selected' : '' }}> Ijin Datang Terlambat dan Pulang Awal</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan Pilih Jenis Ijin
                                    </div>
                                    @error('jenis_ijin')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <strong>Tanggal <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('tanggal') has-error @enderror">
                                    <input class="form-control" type="date" id="tanggal" name = "tanggal" value="{{ old('tanggal') }}" placeholder="Tanggal" autocomplete="off" required/>
                                    @error('tanggal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <strong>Keterangan/Alasan <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-10 col-lg-10 col-md-10">
                                <div class="form-group @error('keterangan') has-error @enderror">
                                    <textarea class="form-control" id="keterangan" name = "keterangan"maxlength = "65535" placeholder="Keterangan" autocomplete="off" required>{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
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
            $('#jenis_ijin').select2({
                width: '100%',
            });
        });
    </script>

@endpush

