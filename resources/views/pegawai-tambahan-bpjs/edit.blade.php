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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-tambahan-bpjs.index') }}">Approval Tambahan BPJS Pegawai</a>
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
                        action="{{ route('pegawai-tambahan-bpjs.update', $bpjs->id) }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PATCH')
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('pegawai')has-error @enderror">
                                    <label>Pegawai </label>
                                    <input type="text" name="pegawai" id="pegawai" value="{{ $pegawai->nama_depan.' '.$pegawai->nama_belakang.' - '.$pegawai->nip.' - '.$pegawai->singkatan_unit_kerja }}"
                                        class="form-control" required="" placeholder="Pegawai" disabled
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('total_orang_tua')has-error @enderror">
                                    <label>Total Orang Tua </label>
                                    <input type="number" name="total_orang_tua" id="total_orang_tua" value="{{ old('total_orang_tua') ?? $bpjs->total_orang_tua }}" disabled
                                        class="form-control" required="" maxlength="100" placeholder="Total orang tua"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('total_mertua')has-error @enderror">
                                    <label>Total Mertua </label>
                                    <input type="number" name="total_mertua" id="total_mertua" value="{{ old('total_mertua') ?? $bpjs->total_mertua }}" disabled
                                        class="form-control" required="" maxlength="100" placeholder="Total mertua"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('total_kelebihan_anak')has-error @enderror">
                                    <label>Total Anak </label>
                                    <input type="number" name="total_kelebihan_anak" id="total_kelebihan_anak" value="{{ old('total_kelebihan_anak') ?? $bpjs->total_kelebihan_anak }}" disabled
                                        class="form-control" required="" maxlength="100" placeholder="Total anak"
                                        autocomplete="off">
                                </div>

                                {{-- file_kartu_bpjs  --}}
                                <div class="form-group @error('file_kartu_bpjs')has-error @enderror">
                                    <label>Upload File Kartu BPJS <span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_kartu_bpjs"
                                        name="file_kartu_bpjs">
                                    <em>Silakan upload file kartu BPJS (pdf/doc/docx/rar/zip max 20Mb)</em>
                                    <br>
                                    @if ($bpjs->file_kartu_bpjs)
                                        <a href="//{{ $bpjs->file_kartu_bpjs }}" target="_blank">Lihat File Kartu BPJS</a>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <a href="{{ route('pegawai-tambahan-bpjs.index') }}">
                            <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                Kembali
                            </button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Setujui</button>
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
                                text: 'Apakah anda yakin ingin setujui pengajuan Tambahan BPJS Pegawai?',
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
                                    swal('Informasi', 'Menyetujui Tambahan BPJS Pegawai dibatalkan', 'error');
                                    event.stopPropagation()
                                }
                            });
                        }
                    }, false)
                });
        })();
    </script>
@endpush
