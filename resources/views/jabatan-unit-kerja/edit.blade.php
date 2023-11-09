@extends('layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush
@push('breadcrumb')
    
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jabatan-unit-kerja.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Jabatan Unit Kerja</a></li>        
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">                    
                    <form id="jabatanUnitKerjaForm" method="post"  action="{{ route('jabatan-unit-kerja.update',$jabatanUnitKerja->id) }}"  accept-charset="utf-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('hirarki_unit_kerja_id') has-error @enderror">
                                    <select class="form-control" id="hirarki_unit_kerja_id" name="hirarki_unit_kerja_id">
                                        <option value="" selected disabled>Pilih HirarkiUnitKerja</option>
                                        @foreach ($hirarkiUnitKerja as $data)
                                            <option value="{{ $data->id }}" {{ (old('hirarki_unit_kerja_id') ?? $jabatan_unit_kerja->hirarki_unit_kerja_id)  == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('hirarki_unit_kerja_id')
                                        <small class="text-danger">{{ $message }}</small>                                    
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('jabatan_tukin_id') has-error @enderror">
                                    <select class="form-control" id="jabatan_tukin_id" name="jabatan_tukin_id">
                                        <option value="" selected disabled>Pilih JabatanTukin</option>
                                        @foreach ($jabatanTukin as $data)
                                            <option value="{{ $data->id }}" {{ (old('jabatan_tukin_id') ?? $jabatan_unit_kerja->jabatan_tukin_id)  == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('jabatan_tukin_id')
                                        <small class="text-danger">{{ $message }}</small>                                    
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ubah</button>
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
        $(document).ready(function() {
            $('#select2').select2();
        });
        $('#jabatanUnitKerjaForm').on('submit', function(e) {
            e.preventDefault();

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
                        $('#jabatanUnitKerjaForm').off('submit').submit();
                    } else {
                        swal('Informasi', 'Ubah data dibatalkan', 'error');
                    }
                });
        });

    </script>
@endpush
