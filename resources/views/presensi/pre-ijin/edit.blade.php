@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ijin.css') }}">
@endpush

@push('breadcrumb')
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
            <a href="/presensi/pre-ijin" class="btn btn-light"><i class="fa fa-list"></i> PreIjin</a>
            <a href="#" class="btn btn-light"><i class="fa fa-pensil"></i> Ubah Data PreIjin</a>
            {{-- <a href="/" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
        </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="preIjinForm" method="post"  action="{{ route('pre-ijin.update',$preIjin->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('no_enroll') has-error @enderror">
                                    <label>No Enroll<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="no_enroll" name = "no_enroll" value = "{{ old('no_enroll') ?? $preIjin->no_enroll }}" placeholder="No Enroll" autocomplete="off"/>
                                    @error('no_enroll')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('jenis_ijin') has-error @enderror">
                                    <label>Jenis Ijin<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="jenis_ijin" name = "jenis_ijin" value = "{{ old('jenis_ijin') ?? $preIjin->jenis_ijin }}" placeholder="Jenis Ijin" autocomplete="off"/>
                                    @error('jenis_ijin')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('tanggal') has-error @enderror">
                                    <label>Tanggal<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="tanggal" name = "tanggal" value = "{{ old('tanggal') ?? $preIjin->tanggal }}" placeholder="Tanggal" autocomplete="off"/>
                                    @error('tanggal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('keterangan') has-error @enderror">
                                    <label>Keterangan<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="keterangan" name = "keterangan" value = "{{ old('keterangan') ?? $preIjin->keterangan }}"maxlength = "65535" placeholder="Keterangan" autocomplete="off"/>
                                    @error('keterangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('status') has-error @enderror">
                                    <label>Status<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="status" name = "status" value = "{{ old('status') ?? $preIjin->status }}" placeholder="Status" autocomplete="off"/>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-check-square" aria-hidden="true"></i> Simpan Perubahan</button>
                    </form>
                </div>

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

        $(document).ready(function() {
            $('#select2').select2();
        });
    </script>
@endpush
