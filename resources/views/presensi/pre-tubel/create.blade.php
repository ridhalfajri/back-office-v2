@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">

    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" />

@endpush

@push('breadcrumb')
        <div class="breadcrumb">
            <a href="/" class="btn btn-link"><i class="fa fa-home"></i> Home</a>
            <div class="btn">></div>
            <a href="/presensi/pre-tubel" class="btn btn-link"><i class="fa fa-list"></i> Tugas Belajar</a>
            <div class="btn">></div>
            <a href="#" class="btn btn-link"><i class="fa fa-pencil"></i> Input Data Tugas Belajar</a>
            {{-- <a href="/gaji" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}

        </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="preTubelForm" method="post"  action="{{ route('pre-tubel.store') }}"  accept-charset="utf-8" novalidate>
                        @csrf

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('no_enroll') has-error @enderror">
                                    <label>Pilih Pegawai :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="no_enroll" name="no_enroll" required>
                                        <option value="" selected disabled>Pilih Nama Pegawai</option>
                                        @foreach ($pegawai as $data)
                                            <option value="{{ $data->id }}" {{ old('no_enroll') == $data->id ? 'selected' : '' }}> NIP: {{ $data->nip }}  Nama : {{ $data->nama }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan Pilih Pegawai
                                    </div>
                                    @error('no_enroll')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('tanggal_tubel') has-error @enderror">
                                    <label>Tanggal Tugas Belajar :<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control input-daterange-datepicker" type="text" name="tanggal_tubel" id="tanggal_tubel" value="">
                                    @error('tanggal_tubel')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('is_active') has-error @enderror">
                                    <label>Tugas Belajar Aktif :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="is_active" name="is_active" required>
                                        <option value="Y" selected>Ya</option>
                                        <option value="N">Tidak</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan Jawab Apakah Tugas Belajar masih aktif/Beraku.
                                    </div>
                                    @error('is_active')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-check-square" aria-hidden="true"></i> Simpan</button>
                    </form>
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
            $('#is_active').select2({
                width: '100%',
            });
            $('#no_enroll').select2({
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

