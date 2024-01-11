@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('pre-dinas-luar.index') }}">Riwayat Dinas Luar</a></li>
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
                         <h3>Ubah Data Pengajuan Dinas Luar</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="student-info">

                    <form class="needs-validation" id="preForm" method="post"  action="{{ route('pre-dinas-luar.update',$preDinasLuar->id) }}" enctype="multipart/form-data"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

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

                        <div class="row">
                            <div class="col-sm-2">
                                <strong>Nama Kegiatan <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group @error('nama_kegiatan') has-error @enderror">
                                    <input class="form-control" type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') ?? $preDinasLuar->nama_kegiatan }}" required>
                                    @error('nama_kegiatan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-2">
                                <strong>Lokasi <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group @error('lokasi') has-error @enderror">
                                    <input class="form-control" type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') ?? $preDinasLuar->lokasi }}" required>
                                    @error('lokasi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-2">
                                <strong>Tanggal Dinas Luar <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group @error('tanggal_dinas') has-error @enderror">
                                    <input class="form-control input-daterange-datepicker" type="text" name="tanggal_dinas" id="tanggal_dinas" value="{{ old('tanggal_dinas') ?? $preDinasLuar->tanggal_dinas }}" required>
                                    @error('tanggal_dinas')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row rowdata">
                            <div class="col-sm-2">
                                <strong>Unggah Surat Tugas (ST)  <span class="text-danger"><sup>*</sup></span></strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('media_st_dinas_luar') has-error @enderror">
                                    <input type="file" name="media_st_dinas_luar" id="media_st_dinas_luar" accept="image/*,.pdf, .doc, .docx" required>
                                    <div class="invalid-feedback">
                                        Silakan Upload File Yang Berisi Tangkapan Layar Daftar Presensi
                                    </div>
                                    @error('media_st_dinas_luar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <strong>Unggah Dokumen Referensi (Optional)</strong>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group @error('media_ref_dinas_luar') has-error @enderror">
                                    <input type="file" name="media_ref_dinas_luar" id="media_ref_dinas_luar" accept="image/*,.pdf, .doc, .docx">
                                    <div class="invalid-feedback">
                                        Silakan Upload File Dokumen Referensi Seperti Nota Dinas atau Undangan
                                    </div>
                                    @error('media_ref_dinas_luar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
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
    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>


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

        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',
            locale: {
                format: 'DD-MM-YYYY'
            },
            autoApply: false
        });

    </script>

@endpush

