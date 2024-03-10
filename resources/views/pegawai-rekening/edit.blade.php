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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-rekening.index') }}">Rekening Pegawai</a>
            </li>
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

                    <form class="needs-validation" id="form-prg" method="post"
                        action="{{ route('pegawai-rekening.update', $prg->id) }}" accept-charset="utf-8"
                        novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('pegawai_id')has-error @enderror">
                                    <label>Nama Pegawai <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="pegawai_id" name="pegawai_id" class="form-control" disabled>
                                        <option value="">--Pilih--</option>
                                        @foreach ($pegawai as $item)
                                            @if ($prg->pegawai_id == $item->id || old('pegawai_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama_pegawai }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama_pegawai }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('bank_id')has-error @enderror">
                                    <label>Bank <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="bank_id" name="bank_id" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($bank as $item)
                                            @if ($prg->bank_id == $item->id || old('bank_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('no_rek')has-error @enderror">
                                    <label>No. Rekening <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_rek" id="no_rek"
                                        value="{{ old('no_rek') ?? $prg->no_rekening }}" class="form-control" required=""
                                        maxlength="100" placeholder="No. Rekening" autocomplete="off">
                                </div>

                                <div class="form-group @error('tipe_rek')has-error @enderror">
                                    <label>Tipe Rekening <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="tipe_rek" name="tipe_rek" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if ($prg->tipe_rekening == 'Gaji & Umak' || old('tipe_rek') == 'Gaji & Umak')
                                            <option value="Gaji & Umak" selected>Gaji & Umak</option>
                                        @else
                                            <option value="Gaji & Umak">Gaji & Umak</option>
                                        @endif
                                        
                                        @if ($prg->tipe_rekening == 'Tukin' || old('tipe_rek') == 'Tukin')
                                            <option value="Tukin" selected>Tukin</option>
                                        @else
                                            <option value="Tukin">Tukin</option>
                                        @endif
                                    </select>
                                </div>

                            </div>
                        </div>

                        <a href="{{ route('pegawai-rekening.index') }}">
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                Kembali
                            </button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ubah</button>
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
        $('#bank_id').select2({
            width: 'resolve'
        });

        $('#tipe_rek').select2({
            width: 'resolve'
        });

        $('#pegawai_id').select2({
            width: 'resolve'
        });

        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault()
                        if (!form.checkValidity()) {
                            event.stopPropagation()
                            form.classList.add('was-validated')
                        } else {
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
    </script>
@endpush
