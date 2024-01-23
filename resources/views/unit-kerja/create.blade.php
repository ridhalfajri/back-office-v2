@extends('template')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('unit-kerja.index') }}">Unit Kerja</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session('message'))
                        <div class="alert alert-warning">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form class="needs-validation" id="form-uker" method="post"  action="{{ route('unit-kerja.store') }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Unit Kerja <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                        class="form-control" required="" maxlength="255" placeholder="Nama Unit Kerja"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('jenis_unit_kerja_id')has-error @enderror">
                                    <label>Jenis Unit Kerja <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="jenis_unit_kerja_id" name="jenis_unit_kerja_id" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($jenisUnit as $item)
                                            @if (old('jenis_unit_kerja_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('singkatan')has-error @enderror">
                                    <label>Singkatan <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="singkatan" id="singkatan" value="{{ old('singkatan') }}"
                                        class="form-control" maxlength="18" placeholder="Singkatan Unit Kerja"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('keterangan')has-error @enderror">
                                    <label>Keterangan </label>
                                    <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan') }}"
                                        class="form-control" maxlength="100" placeholder="Keterangan Unit Kerja"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('is_active')has-error @enderror">
                                    <label>Status <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="is_active" name="is_active" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if (old('is_active') == 'Y')
                                            <option value="Y" selected>Aktif</option>
                                        @else
                                            <option value="Y">Aktif</option>
                                        @endif
    
                                        @if (old('is_active') == 'N')
                                            <option value="N" selected>Tidak Aktif</option>
                                        @else
                                            <option value="N">Tidak Aktif</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('unit-kerja.index') }}">
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                Kembali
                            </button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript">

        $('#jenis_unit_kerja_id').select2({
            width: 'resolve'
        });

        $('#is_active').select2({
            width: 'resolve'
        });

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

    </script>
@endpush