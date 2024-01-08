@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">

    <style>
        .hidden {
            display: none;
        }
    </style>

@endpush

@push('breadcrumb')
        <div class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
            <a href="{{ route('jabatan-tukin.index') }}" class="btn btn-light"><i class="fa fa-list"></i> Tunjangan Kinerja Jabatan</a>
            <a href="#" class="btn"><i class="fa fa-pencil-square" aria-hidden="true"></i> Ubah JabatanTukin Baru</a>
            {{-- <a href="/" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
        </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card col-4">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="jabatanTukinForm" method="post"  action="{{ route('jabatan-tukin.update',$jabatanTukin->id) }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('jenis_jabatan_id') has-error @enderror">
                                    <label>Jenis Jabatan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="jenis_jabatan_id" name="jenis_jabatan_id"  onchange="toggleInput(this.value)" required>
                                        <option value="" selected disabled>--Pilih Jenis Jabatan --</option>
                                        @foreach ($jenisJabatan as $data)
                                            <option value="{{ $data->id }}" {{ (old('jenis_jabatan_id') ?? $jabatanTukin->jenis_jabatan_id)  == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih JenisJabatan.
                                    </div>
                                    @error('jenis_jabatan_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group  @error('jabatan_id') has-error @enderror">
                                    <label>Jabatan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                                        <option value="" selected disabled>-- Pilih Jabatan --</option>
                                    </select>
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
                                            <option value="{{ $data->id }}" {{ (old('tukin_id') ?? $jabatanTukin->tukin_id)  == $data->id ? 'selected' : '' }}>Grade: {{ $data->grade }}        Nominal: Rp {{ $data->nominal }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih Tukin.
                                    </div>
                                    @error('tukin_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12 {{  $jabatanTukin->jenis_jabatan_id ==4 ? 'hidden' :''  }}" id="inputTunjab" name= "inputTunjab">
                                <div class="form-group @error('nominal') has-error @enderror">
                                    <label>Nominal Tunjangan Jabatan<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="nominal_tunjangan_jabatan" name = "nominal_tunjangan_jabatan" placeholder="Tunjangan Jabatan Umum" autocomplete="off"/>
                                    @error('nominal_tunjangan_jabatan')
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
            $('#jenis_jabatan_id').select2();
            $('#jabatan_id').select2();
            $('#tukin_id').select2();

            var jenis_jabatan_id = {!! json_encode(is_null(old('jenis_jabatan_id')) ? $jabatanTukin->jenis_jabatan_id : old('jenis_jabatan_id')) !!};
            var jabatan_id = {!! json_encode(is_null(old('jabatan_id')) ? $jabatanTukin->jabatan_id : old('jabatan_id')) !!};
            var tunjab = {!! json_encode(is_null(old('nominal_tunjangan_jabatan')) ? $jabatan->nominal_tunjangan : old('nominal_tunjangan_jabatan')) !!};

            let formattedValue = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(tunjab);

            document.getElementById("nominal_tunjangan_jabatan").value = formattedValue;

            console.log(jenis_jabatan_id);
            get_jabatan(jenis_jabatan_id, jabatan_id);


            $("#nominal_tunjangan_jabatan").on("keyup change", function(e) {
                // Ambil nilai teks dari input
                let inputValue =  $("#nominal_tunjangan_jabatan").val();
                // Hapus semua karakter non-angka
                inputValue = inputValue.replace(/\D/g, '');
                // Format angka menjadi format mata uang Indonesia
                let formattedValue = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(inputValue);

                $("#nominal_tunjangan_jabatan").val(formattedValue);
            });

        });

        $('#jenis_jabatan_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
            get_jabatan(id)
        });

        document.getElementById("jabatan_id").onload = function() {
            const jabId = 1;
            console.log('OK');
            get_jabatan(jabId);

        };

        $('#jabatan_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
        });

        const get_jabatan = (jenis_jabatan_id = null, jabatan_id = null) => {

            $.ajax({
                type: "POST",
                url: "{{ route('jabatan-tukin.getjabatan') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    jabatan_id: jabatan_id,
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

        function toggleInput(selectedValue) {
            var inputTunjab = document.getElementById('inputTunjab');

            // Show input box if the selected value is not '0', hide otherwise
            if (selectedValue !== '4') {
                inputTunjab.classList.remove('hidden');
            } else {
                inputTunjab.classList.add('hidden');
                // Optionally clear the input field when hiding
                document.getElementById('nominal_tunjangan_jabatan').value = '0';
            }
        }


    </script>
@endpush
