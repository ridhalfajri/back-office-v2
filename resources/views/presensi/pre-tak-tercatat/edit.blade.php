@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
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
                <div class="card-content">
                    <form class="needs-validation" id="preTakTercatatForm" method="post"  action="{{ route('pre-tak-tercatat.update',$preTakTercatat->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('no_enroll') has-error @enderror">
                                    <label>No Enroll<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="no_enroll" name = "no_enroll" value = "{{ old('no_enroll') ?? $preTakTercatat->no_enroll }}" placeholder="No Enroll" autocomplete="off"/>
                                    @error('no_enroll')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('tanggal_pengajuan') has-error @enderror">
                                    <label>Tanggal Pengajuan<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="tanggal_pengajuan" name = "tanggal_pengajuan" value = "{{ old('tanggal_pengajuan') ?? $preTakTercatat->tanggal_pengajuan }}" placeholder="Tanggal Pengajuan" autocomplete="off"/>
                                    @error('tanggal_pengajuan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('tanggal_approved') has-error @enderror">
                                    <label>Tanggal Approved<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="tanggal_approved" name = "tanggal_approved" value = "{{ old('tanggal_approved') ?? $preTakTercatat->tanggal_approved }}" placeholder="Tanggal Approved" autocomplete="off"/>
                                    @error('tanggal_approved')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('jenis') has-error @enderror">
                                    <label>Jenis<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="jenis" name = "jenis" value = "{{ old('jenis') ?? $preTakTercatat->jenis }}" placeholder="Jenis" autocomplete="off"/>
                                    @error('jenis')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('jam_perubahan') has-error @enderror">
                                    <label>Jam Perubahan<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"id="jam_perubahan" name = "jam_perubahan" value = "{{ old('jam_perubahan') ?? $preTakTercatat->jam_perubahan }}" placeholder="Jam Perubahan" autocomplete="off"/>
                                    @error('jam_perubahan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('atasan_approval_id') has-error @enderror">
                                    <label>Atasan Approval Id<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="atasan_approval_id" name = "atasan_approval_id" value = "{{ old('atasan_approval_id') ?? $preTakTercatat->atasan_approval_id }}" placeholder="Atasan Approval Id" autocomplete="off"/>
                                    @error('atasan_approval_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('status') has-error @enderror">
                                    <label>Status<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="status" name = "status" value = "{{ old('status') ?? $preTakTercatat->status }}" placeholder="Status" autocomplete="off"/>
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
            $('#jenis').select2({
                width: '100%',
            });
        });
    </script>
@endpush
