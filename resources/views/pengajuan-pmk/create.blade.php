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
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-pmk.index') }}">Pengajuan Tambahan Masa Kerja</a>
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
                        action="{{ route('pengajuan-pmk.store') }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('tahun_plus_pengajuan')has-error @enderror">
                                    <label>Total Tahun Pengajuan <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="tahun_plus_pengajuan" id="tahun_plus_pengajuan" value="{{ old('tahun_plus_pengajuan') }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total tahun pengajuan"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('bulan_plus_pengajuan')has-error @enderror">
                                    <label>Total Bulan Pengajuan <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="bulan_plus_pengajuan" id="bulan_plus_pengajuan" value="{{ old('bulan_plus_pengajuan') }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total bulan pengajuan"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('tipe_pengalaman')has-error @enderror">
                                    <label>Tipe PMK <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="tipe_pengalaman" name="tipe_pengalaman" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if (old('tipe_pengalaman') == 'Non-Pemerintahan')
                                            <option value="Non-Pemerintahan" selected>Non-Pemerintahan</option>
                                        @else
                                            <option value="Non-Pemerintahan">Non-Pemerintahan</option>
                                        @endif

                                        @if (old('tipe_pengalaman') == 'Pemerintahan')
                                            <option value="Pemerintahan" selected>Pemerintahan</option>
                                        @else
                                            <option value="Pemerintahan">Pemerintahan</option>
                                        @endif

                                        @if (old('tipe_pengalaman') == 'Non-Pemerintahan dan Pemerintahan')
                                            <option value="Non-Pemerintahan dan Pemerintahan" selected>Non-Pemerintahan dan Pemerintahan</option>
                                        @else
                                            <option value="Non-Pemerintahan dan Pemerintahan">Non-Pemerintahan dan Pemerintahan</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('file_pengajuan_pmk')has-error @enderror">
                                    <label>Upload File Pengajuan PMK <span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_pengajuan_pmk"
                                        name="file_pengajuan_pmk">
                                    <em>Silakan upload file pengajuan pmk (rar/zip max 50Mb)</em>
                                    <br>
                                    <em>Format nama file: Pengajuan-PMK_'nama'_'nip'_'unit kerja'</em>
                                </div>

                                <div class="form-group @error('keterangan')has-error @enderror">
                                    <label>Keterangan </label>
                                    <textarea name="keterangan" id="keterangan" rows="2"
                                        class="form-control form-control-plaintext" placeholder="Keterangan pengajuan PMK"
                                        autocomplete="off">{{ old('keterangan') }}</textarea>
                                </div>

                            </div>

                        </div>

                        <a href="{{ route('pengajuan-pmk.index') }}">
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
        $('#tipe_pengalaman').select2({
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
