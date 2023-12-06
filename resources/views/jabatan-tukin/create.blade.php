@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
            <a href="{{ route('jabatan-tukin.index') }}" class="btn btn-light"><i class="fa fa-list"></i> Tunjangan Kinerja Jabatan</a>
            <a href="#" class="btn"><i class="fa fa-keyboard-o" aria-hidden="true"></i> Input Data Tunjangan Kinerja Baru</a>
            {{-- <a href="/" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
        </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="jabatanTukinForm" method="post"  action="{{ route('jabatan-tukin.store') }}"  accept-charset="utf-8" novalidate>
                        @csrf

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('jenis_jabatan_id') has-error @enderror">
                                    <label>Jenis Jabatan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="jenis_jabatan_id" name="jenis_jabatan_id" required>
                                        <option value="" selected disabled>Pilih Jenis Jabatan</option>
                                        @foreach ($jenisJabatan as $data)
                                            <option value="{{ $data->id }}" {{ old('jenis_jabatan_id') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih Jenis Jabatan.
                                    </div>
                                    @error('jenis_jabatan_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('jabatan_id') has-error @enderror">
                                    <label>Jabatan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                                        <option value="" selected disabled>-- Pilih Jabatan --</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih Jabatan.
                                    </div>
                                    @error('jabatan_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('tukin_id') has-error @enderror">
                                    <label>Grade Tunjangan Kinerja Berdasarkan Jabatan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="tukin_id" name="tukin_id" required>
                                        <option value="" selected disabled>-- Pilih Tunjangan Kinerja --</option>
                                        @foreach ($tukin as $data)
                                            <option value="{{ $data->id }}" {{ old('tukin_id') == $data->id ? 'selected' : '' }}>Grade: {{ $data->grade }}        Nominal: Rp {{ $data->nominal }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih Tunjangan Kinerja.
                                    </div>
                                    @error('tukin_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-check-square" aria-hidden="true"></i> Simpan</button>
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
                    // Konfirmasi sebelum menyimpan data
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
                            form.submit()
                        } else {
                            swal('Informasi', 'Simpan data dibatalkan', 'error');
                            event.stopPropagation()
                        }
                    });
                }
              }, false)
            });
        })();

        $(document).ready(function() {
            $('#jenis_jabatan_id').select2();
            $('#jabatan_id').select2();
            $('#tukin_id').select2();

            var jenis_jabatan_id = {!! json_encode(is_null(old('jenis_jabatan_id')) ? '-' : old('jenis_jabatan_id')) !!};
            var jabatan_id = {!! json_encode(is_null(old('jabatan_id')) ? '-' : old('jabatan_id')) !!};

            if (jenis_jabatan_id!="-" && jabatan_id!="-"){
                console.log(jenis_jabatan_id);
                get_jabatan(jenis_jabatan_id, jabatan_id);
            }

        });

        $('#jenis_jabatan_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
            get_jabatan(id)
        });

        $('#jabatan_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
        });

        const get_jabatan = (jenis_jabatan_id = null) => {

            $.ajax({
                type: "POST",
                url: "{{ route('jabatan-tukin.getjabatan') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    jenis_jabatan_id: jenis_jabatan_id
                },
                cache: false,
                success: function(response) {
                    // Clear existing options
                    $('#jabatan_id').empty();
                    // Add default option
                    $('#jabatan_id').append(response);
                    // Initialize Select2
                    $('#jabatan_id').select2();

                    var oldjabatanId = @json(old('jabatan_id'));
                    if (oldjabatanId !== null) {
                        $('#jabatan_id').val(oldjabatanId).trigger('change');
                    }

                },
                error: function(data) {
                    console.log('error : ', data);
                }
            });
        }

    </script>

@endpush

