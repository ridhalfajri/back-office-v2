@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="/presensi/pre-jam-kerja">Pengaturan Jam Kerja</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="preJamKerjaForm" method="post"  action="{{ route('pre-jam-kerja.update',$preJamKerja->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Jam Kerja Hari Senin - Kamis</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row clearfix">
                                            <div class="col-6 col-lg-6 col-md-6">
                                                <div class="form-group @error('jam_masuk') has-error @enderror">
                                                    <label>Jam Masuk<span class="text-danger"><sup>*</sup></span></label>
                                                    <input class="form-control" type = "time" id="jam_masuk" name = "jam_masuk" value="{{ old('jam_masuk') ?? $preJamKerja->jam_masuk }}" placeholder="Jam Masuk" autocomplete="off"/>
                                                    @error('jam_masuk')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6 col-lg-6 col-md-6">
                                                <div class="form-group @error('jam_pulang') has-error @enderror">
                                                    <label>Jam Pulang<span class="text-danger"><sup>*</sup></span></label>
                                                    <input class="form-control" type = "time" id="jam_pulang" name = "jam_pulang" value="{{ old('jam_pulang') ?? $preJamKerja->jam_pulang }}" placeholder="Jam Pulang" autocomplete="off"/>
                                                    @error('jam_pulang')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Jam Kerja Hari Jum'at</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group @error('jam_masuk_khusus') has-error @enderror">
                                                    <label>Jam Masuk<span class="text-danger"><sup>*</sup></span></label>
                                                    <input class="form-control" type = "time" id="jam_masuk_khusus" name = "jam_masuk_khusus" value="{{ old('jam_masuk_khusus') ?? $preJamKerja->jam_masuk_khusus }}" placeholder="Jam Masuk" autocomplete="off"/>
                                                    @error('jam_masuk_khusus')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group @error('jam_pulang_khusus') has-error @enderror">
                                                    <label>Jam Pulang<span class="text-danger"><sup>*</sup></span></label>
                                                    <input class="form-control" type = "time" id="jam_pulang_khusus" name = "jam_pulang_khusus" value="{{ old('jam_pulang_khusus') ?? $preJamKerja->jam_pulang_khusus }}" placeholder="Jam Pulang" autocomplete="off"/>
                                                    @error('jam_pulang_khusus')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group @error('waktu_floating') has-error @enderror">
                                    <label>Waktu Floating<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type = "time" id="waktu_floating" name = "waktu_floating" value="{{  old('waktu_floating') ?? $preJamKerja->waktu_floating }}" placeholder="Waktu Floating" autocomplete="off"/>
                                    @error('waktu_floating')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group @error('is_active') has-error @enderror">
                                    <label>Aktifkan Jam Kerja :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="is_active" name = "is_active">
                                        <option value="Y" {{ (old('is_active') == 'Y' || $preJamKerja->is_active=='Y') ? 'selected' : '' }}>Ya</option>
                                        <option value="N" {{ (old('is_active') == 'N' || $preJamKerja->is_active=='N') ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('is_active')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-8 col-lg-8 col-md-8">
                                <div class="form-group  @error('keterangan') has-error @enderror">
                                    <label>Keterangan<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="keterangan" name = "keterangan" value = "{{ old('keterangan') ?? $preJamKerja->keterangan }}"maxlength = "65535" placeholder="Keterangan" autocomplete="off"/>
                                    @error('keterangan')
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
