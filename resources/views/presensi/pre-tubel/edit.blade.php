@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
        <div class="breadcrumb">
            <a href="/" class="btn btn-link"><i class="fa fa-home"></i> Home</a>
            <div class="btn">></div>
            <a href="/presensi/pre-tubel" class="btn btn-link"><i class="fa fa-list"></i> Tugas Belajar</a>
            <div class="btn">></div>
            <a href="#" class="btn btn-link"><i class="fa fa-pencil"></i> Ubah Data Tugas Belajar</a>
        </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="preTubelForm" method="post"  action="{{ route('pre-tubel.update',$preTubel->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('no_enroll') has-error @enderror">
                                    <label>No Enroll<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="no_enroll" name = "no_enroll" value = "{{ old('no_enroll') ?? $preTubel->no_enroll }}" placeholder="No Enroll" autocomplete="off"/>
                                    @error('no_enroll')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('tanggal_awal') has-error @enderror">
                                    <label>Tanggal Awal<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="tanggal_awal" name = "tanggal_awal" value = "{{ old('tanggal_awal') ?? $preTubel->tanggal_awal }}" placeholder="Tanggal Awal" autocomplete="off"/>
                                    @error('tanggal_awal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('tanggal_akhir') has-error @enderror">
                                    <label>Tanggal Akhir<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="tanggal_akhir" name = "tanggal_akhir" value = "{{ old('tanggal_akhir') ?? $preTubel->tanggal_akhir }}" placeholder="Tanggal Akhir" autocomplete="off"/>
                                    @error('tanggal_akhir')
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
