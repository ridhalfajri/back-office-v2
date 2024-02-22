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
            <li class="breadcrumb-item"><a href="{{ route('status-pegawai.index') }}">Status Pegawai</a></li>
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

                    <form class="needs-validation" id="form-status" method="post"
                        action="{{ route('status-pegawai.store') }}" accept-charset="utf-8" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Status Pegawai <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                        class="form-control" required="" maxlength="30" placeholder="Nama Status Pegawai"
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

                        <a href="{{ route('status-pegawai.index') }}">
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
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
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
