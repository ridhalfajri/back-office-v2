@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
    <div class="btn-group btn-breadcrumb">
        <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
        <a href="/gaji" class="btn btn-light"><i class="fa fa-list"></i> Gaji</a>
        <a href="#" class="btn btn-light"><i class="fa fa-pensil"></i> Input Gaji Baru</a>
        {{-- <a href="/gaji" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
    </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form id="gajiForm" method="post"  action="{{ route('gaji.store') }}"  accept-charset="utf-8">
                        @csrf

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('golongan_id') has-error @enderror">
                                    <label>Golongan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="golongan_id" name="golongan_id">
                                        <option value="" selected disabled>Pilih Golongan</option>
                                        @foreach ($golongan as $data)
                                            <option value="{{ $data->id }}" {{ old('golongan_id') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('golongan_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('masa_kerja') has-error @enderror">
                                    <label>Masa Kerja<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="masa_kerja" name = "masa_kerja" placeholder="Masa Kerja" autocomplete="off"/>
                                    @error('masa_kerja')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('nominal') has-error @enderror">
                                    <label>Nominal<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="nominal" name = "nominal" placeholder="Nominal" autocomplete="off"/>
                                    @error('nominal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
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
     <script>
        $(document).ready(function() {
            $('#golongan_id').select2();
        });
        $('#gajiForm').on('submit', function(e) {
            e.preventDefault();

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
                        $('#gajiForm').off('submit').submit();
                    } else {
                        swal('Informasi', 'Simpan data dibatalkan', 'error');
                    }
                });
        });

    </script>
@endpush

