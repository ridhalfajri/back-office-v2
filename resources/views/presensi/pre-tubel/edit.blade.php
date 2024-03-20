@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('pre-tubel.index') }}">Riwayat Tugas Belajar</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="card col-4">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="preTubelForm" method="post"  action="{{ route('pre-tubel.update',$preTubel->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('no_enroll') has-error @enderror">
                                    <label>Pilih Pegawai :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="no_enroll" name="no_enroll" required>
                                        <option value="" selected disabled>Pilih Nama Pegawai</option>
                                        @foreach ($pegawai as $data)
                                            <option value="{{ $data->no_enroll }}" {{ ($data->no_enroll == $preTubel->no_enroll || old('no_enroll') == $data->no_enroll) ? 'selected' : '' }}> NIP: {{ $data->nip }}  Nama : {{ $data->nama }}</option>
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

                            <div class="col-12 col-lg-12 col-md-12"  style="top: 10px">
                                <div class="form-group  @error('tanggal_awal') has-error @enderror">
                                    <label>Tanggal Tugas Belajar<span class="text-danger"><sup>*</sup></span></label>
                                </div>
                            </div>
                            <div class="col-4 col-lg-4 col-md-4">
                                <div class="form-group  @error('tanggal_awal') has-error @enderror">
                                    <input class="form-control" type ="date" id="tanggal_awal" name = "tanggal_awal" value = "{{ old('tanggal_awal') ?? $preTubel->tanggal_awal }}" placeholder="Tanggal Awal" autocomplete="off"/>
                                    @error('tanggal_awal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-auto" style="width: 30px; top: 10px">
                                <div>
                                    <label>s/d </label>
                                </div>
                            </div>
                            <div class="col-4 col-lg-4 col-md-4">
                                <div class="form-group  @error('tanggal_akhir') has-error @enderror">
                                    <input class="form-control" type ="date" id="tanggal_akhir" name = "tanggal_akhir" value = "{{ old('tanggal_akhir') ?? $preTubel->tanggal_akhir }}" placeholder="Tanggal Akhir" autocomplete="off"/>
                                    @error('tanggal_akhir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-4 col-lg-4 col-md-4">
                                <div class="form-group @error('is_active') has-error @enderror">
                                    <label>Tugas Belajar Aktif :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="is_active" name="is_active" required>
                                        <option value="Y" {{ ($preTubel->is_active == 'Y' || old('is_active') == 'Y') ? 'selected' : '' }}>Ya</option>
                                        <option value="N" {{ ($preTubel->is_active == 'N' || old('is_active') == 'N') ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan Jawab Apakah Tugas Belajar masih aktif/Berlaku.
                                    </div>
                                    @error('is_active')
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
            $('#is_active').select2({
                width: '100%',
            });
            $('#no_enroll').select2({
                width: '100%',
            });
        });
    </script>
@endpush
