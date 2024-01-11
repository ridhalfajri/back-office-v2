@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('gaji.index') }}">Gaji Pegawai</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
</nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form id="gajiForm" method="post"  action="{{ route('gaji.update',$gaji->id) }}"  accept-charset="utf-8">
                        @csrf
                        @method('PUT')

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('golongan_id') has-error @enderror">
                                    <label>Golongan :<span class="text-danger"><sup>*</sup></span></label>
                                    <select class="form-control" id="golongan_id" name="golongan_id">
                                        <option value="" selected disabled>Pilih Golongan</option>
                                        @foreach ($golongan as $data)
                                            <option value="{{ $data->id }}" {{ (old('golongan_id') ?? $gaji->golongan_id)  == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
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
                                <div class="form-group  @error('masa_kerja') has-error @enderror">
                                    <label>Masa Kerja<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"  id="masa_kerja" name = "masa_kerja" value = "{{ old('masa_kerja') ?? $gaji->masa_kerja }}" placeholder="Masa Kerja" autocomplete="off"/>
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
                                    <input class="form-control"  id="nominal" name = "nominal" value = "{{ old('nominal') ?? $gaji->nominal }}" placeholder="Nominal" autocomplete="off"/>
                                    @error('nominal')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('nominal') has-error @enderror">
                                    <label>Tunjab Umum<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="nominal_tunjangan_jabatan" name = "nominal_tunjangan_jabatan" placeholder="Tunjangan Jabatan Umum" autocomplete="off"/>
                                    @error('nominal_tunjangan_jabatan')
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
            $('#golongan_id').select2();

            var nominal = {!! json_encode(old('nominal') ?? $gaji->nominal) !!};
            var nominalTunjabUmum = {!! json_encode(old('nominal_tunjangan_jabatan') ?? $gaji->nominal_tunjangan_jabatan) !!};

            document.getElementById("nominal").value = nominal;
            document.getElementById("nominal_tunjangan_jabatan").value = nominalTunjabUmum;


            $("#nominal").on("keyup change", function(e) {
                // Ambil nilai teks dari input
                let inputValue =  $("#nominal").val();
                // Hapus semua karakter non-angka
                inputValue = inputValue.replace(/\D/g, '');
                // Format angka menjadi format mata uang Indonesia
                let formattedValue = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(inputValue);
                console.log(formattedValue);
                $("#nominal").val(formattedValue);
            });

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
        $('#gajiForm').on('submit', function(e) {
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
                        $('#gajiForm').off('submit').submit();
                    } else {
                        swal('Informasi', 'Ubah data dibatalkan', 'error');
                    }
                });
        });

    </script>
@endpush
