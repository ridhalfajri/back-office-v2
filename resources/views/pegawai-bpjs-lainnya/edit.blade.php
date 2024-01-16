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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-bpjs-lainnya.index') }}">Tambahan BPJS Pegawai</a>
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

                    <form class="needs-validation" id="form-pbl" method="post"
                        action="{{ route('pegawai-bpjs-lainnya.update', $pbl->id) }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('pegawai_id')has-error @enderror">
                                    <label>Nama Pegawai <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="pegawai_id" name="pegawai_id" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($pegawai as $item)
                                            @if ($pbl->pegawai_id == $item->id || old('pegawai_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama_pegawai }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama_pegawai }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('total_ortu')has-error @enderror">
                                    <label>Total Orang Tua <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_ortu" id="total_ortu" value="{{ old('total_ortu') ?? $pbl->total_orang_tua }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total orang tua"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('total_mertua')has-error @enderror">
                                    <label>Total Mertua <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_mertua" id="total_mertua" value="{{ old('total_mertua') ?? $pbl->total_mertua }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total mertua"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('total_anak')has-error @enderror">
                                    <label>Total Tambahan Anak <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="total_anak" id="total_anak" value="{{ old('total_anak') ?? $pbl->total_kelebihan_anak }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total tambahan anak"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('is_active')has-error @enderror">
                                    <label>Status <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="is_active" name="is_active" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if ($pbl->is_active == '1' || old('is_active') == '1')
                                            <option value="1" selected>Aktif</option>
                                        @else
                                            <option value="1">Aktif</option>
                                        @endif

                                        @if ($pbl->is_active == '0' || old('is_active') == '0')
                                            <option value="0" selected>Tidak Aktif</option>
                                        @else
                                            <option value="0">Tidak Aktif</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('file_tambahan_bpjs')has-error @enderror">
                                    <label>Upload File Pendukung </label>
                                    <input class="form-control fileClass" type="file" id="file_tambahan_bpjs"
                                        name="file_tambahan_bpjs">
                                    <em>Silakan upload file pendukung (pdf/rar/zip max 2Mb)</em>
                                    <br>
                                    @if ($pbl->file_tambahan_bpjs)
                                        <a href="//{{ $pbl->file_tambahan_bpjs }}" target="_blank">Download</a>
                                    @endif
                                </div>

                            </div>

                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('kosong')has-error @enderror">
                                    <br>
                                    <br>
                                    <br>
                                </div>

                                <div class="form-group @error('ket_ortu')has-error @enderror">
                                    <label for="ket_ortu">Keterangan Orang Tua </label>
                                    <textarea  name="ket_ortu" id="ket_ortu" rows="1"
                                        class="form-control form-control-plaintext" placeholder="Keterangan data orang tua (no kk, nik, nama, ttl, no hp, email)"
                                        autocomplete="off">{{ old('ket_ortu') ?? $pbl->keterangan_orang_tua }}</textarea>
                                </div>

                                <div class="form-group @error('ket_mertua')has-error @enderror">
                                    <label for="ket_mertua">Keterangan Orang Tua </label>
                                    <textarea name="ket_mertua" id="ket_mertua" rows="1"
                                        class="form-control form-control-plaintext" placeholder="Keterangan data mertua (no kk, nik, nama, ttl, no hp, email)"
                                        autocomplete="off">{{ old('ket_mertua') ?? $pbl->keterangan_mertua }}</textarea>
                                </div>

                                <div class="form-group @error('ket_anak')has-error @enderror">
                                    <label for="ket_anak">Keterangan Anak </label>
                                    <textarea name="ket_anak" id="ket_anak" rows="1"
                                        class="form-control form-control-plaintext" placeholder="Keterangan data anak (no kk, nik, nama, ttl, no hp, email)"
                                        autocomplete="off">{{ old('ket_anak') ?? $pbl->keterangan_kelebihan_anak }}</textarea>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('pegawai-bpjs-lainnya.index') }}">
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
        $('#is_active').select2({
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
