@extends('layout')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-primary"><i class="fa fa-home"></i></a>
            <a href="{{ route('gaji.index') }}" class="btn btn-info"><i class="fa fa-list"></i> Gaji</a>
            <a href="#" class="btn"><i class="fa fa-pencil-square" aria-hidden="true"></i> Ubah Gaji Baru</a>
            {{-- <a href="/" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
        </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="gajiForm" method="post"  action="{{ route('gaji.update',$gaji->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('golongan_id') has-error @enderror">
                                    <label>Golongan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="golongan_id" name="golongan_id" required>
                                        <option value="" selected disabled>Pilih Golongan</option>
                                        @foreach ($golongan as $data)
                                            <option value="{{ $data->id }}" {{ (old('golongan_id') ?? $gaji->golongan_id)  == $data->id ? 'selected' : '' }}>{{ "Gol: " . $data->nama . "  " . $data->nama_pangkat }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih Golongan.
                                    </div>
                                    @error('golongan_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('masa_kerja') has-error @enderror">
                                    <label>Masa Kerja<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type="number" id="masa_kerja" name = "masa_kerja" value = "{{ old('masa_kerja') ?? $gaji->masa_kerja }}" placeholder="Masa Kerja" autocomplete="off" required/>
                                    @error('masa_kerja')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('nominal') has-error @enderror">
                                    <label>Nominal<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="nominal" name = "nominal" value = "{{ number_format(preg_replace('/[^\d]/', '', (old('nominal') ?? $gaji->nominal)), 0, ',', '.')  }}" placeholder="Nominal" autocomplete="off" required/>
                                    @error('nominal')
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
            $('#golongan_id').select2();
            $("#nominal").on("keyup change", function(e) {
                // Ambil nilai teks dari input
                let inputValue =  $("#nominal").val();
                // Hapus semua karakter non-angka
                inputValue = inputValue.replace(/\D/g, '');
                // Format angka menjadi format mata uang Indonesia
                let formattedValue = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(inputValue);
                console.log(formattedValue);
                $("#nominal").val(formattedValue);
            })
        });


    </script>
@endpush
