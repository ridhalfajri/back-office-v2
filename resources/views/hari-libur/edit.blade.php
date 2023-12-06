@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-primary"><i class="fa fa-home"></i></a>
            <a href="/hari-libur" class="btn btn-info"><i class="fa fa-list"></i> HariLibur</a>
            <a href="#" class="btn btn-warning"><i class="fa fa-pensil"></i> Ubah Data HariLibur</a>
            {{-- <a href="/" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
        </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="hariLiburForm" method="post"  action="{{ route('hari-libur.update',$hariLibur->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('is_libur') has-error @enderror">
                                    <label>Is Libur<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="is_libur" name = "is_libur" value = "{{ old('is_libur') ?? $hariLibur->is_libur }}" placeholder="Is Libur" autocomplete="off"/>
                                    @error('is_libur')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('keterangan') has-error @enderror">
                                    <label>Keterangan<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="keterangan" name = "keterangan" value = "{{ old('keterangan') ?? $hariLibur->keterangan }}"maxlength = "100" placeholder="Keterangan" autocomplete="off"/>
                                    @error('keterangan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('tahun') has-error @enderror">
                                    <label>Tahun<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="tahun" name = "tahun" value = "{{ old('tahun') ?? $hariLibur->tahun }}" placeholder="Tahun" autocomplete="off"/>
                                    @error('tahun')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('tanggal') has-error @enderror">
                                    <label>Tanggal<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="tanggal" name = "tanggal" value = "{{ old('tanggal') ?? $hariLibur->tanggal }}" placeholder="Tanggal" autocomplete="off"/>
                                    @error('tanggal')
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
