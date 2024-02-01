@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('jabatan-unit-kerja.index') }}">Jabatan Unit Kerja</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
</nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="card col-6">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="jabatanUnitKerjaForm" method="post"  action="{{ route('jabatan-unit-kerja.update',$jabatanUnitKerja->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('jabatan_tukin_id') has-error @enderror">
                                    <label>Jabatan Tukin :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="jabatan_tukin_id" name="jabatan_tukin_id" required>
                                        <option value="" selected disabled>Pilih Jabatan Tukin</option>
                                        @foreach ($jabatanTukin as $data)
                                            <option value="{{ $data->id }}" {{ (old('jabatan_tukin_id') ?? $jabatanUnitKerja->jabatan_tukin_id)  == $data->id ? 'selected' : '' }}>{{ $data->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih Jabatan Tukin.
                                    </div>
                                    @error('jabatan_tukin_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('hirarki_unit_kerja_id') has-error @enderror">
                                    <label>Unit Kerja :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="hirarki_unit_kerja_id" name="hirarki_unit_kerja_id" required>
                                        <option value="" selected disabled>Pilih Unit Kerja</option>
                                        @foreach ($hirarkiUnitKerja as $data)
                                            <option value="{{ $data->id }}" {{ (old('hirarki_unit_kerja_id') ?? $jabatanUnitKerja->hirarki_unit_kerja_id)  == $data->id ? 'selected' : '' }}>{{ $data->nama_unit_kerja }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih Unit Kerja.
                                    </div>
                                    @error('hirarki_unit_kerja_id')
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
            $('#jabatan_tukin_id').select2();
            $('#hirarki_unit_kerja_id').select2();
        });
    </script>
@endpush
