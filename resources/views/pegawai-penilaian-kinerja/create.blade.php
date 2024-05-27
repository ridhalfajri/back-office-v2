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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-penilaian-kinerja.index') }}">Penilaian Kinerja Pegawai</a>
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
                        action="{{ route('pegawai-penilaian-kinerja.store') }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('pegawai_id')has-error @enderror">
                                    <label>Nama Pegawai <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="pegawai_id" name="pegawai_id" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($pegawai as $item)
                                            @if (old('pegawai_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama_pegawai }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama_pegawai }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('tgl_nilai')has-error @enderror">
                                    <label>Tanggal Nilai <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tgl_nilai" name="tgl_nilai" value="{{ old('tgl_nilai') }}">
                                </div>

                                <div class="form-group @error('tw')has-error @enderror">
                                    <label>TW <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="tw" name="tw" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if (old('tw') == '1')
                                            <option value="1" selected>1</option>
                                        @else
                                            <option value="1">1</option>
                                        @endif

                                        @if (old('tw') == '2')
                                            <option value="2" selected>2</option>
                                        @else
                                            <option value="2">2</option>
                                        @endif

                                        @if (old('tw') == '3')
                                            <option value="3" selected>3</option>
                                        @else
                                            <option value="3">3</option>
                                        @endif

                                        @if (old('tw') == '4')
                                            <option value="4" selected>4</option>
                                        @else
                                            <option value="4">4</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('tahun_nilai')has-error @enderror">
                                    <label>Tahun Nilai <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="tahun_nilai" name="tahun_nilai" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($years as $year)
                                            @if (old('tahun_nilai') == $year)
                                                <option value="{{ $year }}" selected>{{ $year }}
                                                </option>
                                            @else
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('nilai')has-error @enderror">
                                    <label>Nilai <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="nilai" name="nilai" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @if (old('nilai') == 'Butuh Perbaikan')
                                            <option value="Butuh Perbaikan" selected>Butuh Perbaikan</option>
                                        @else
                                            <option value="Butuh Perbaikan">Butuh Perbaikan</option>
                                        @endif

                                        @if (old('nilai') == 'Kurang')
                                            <option value="Kurang" selected>Kurang</option>
                                        @else
                                            <option value="Kurang">Kurang</option>
                                        @endif

                                        @if (old('nilai') == 'Sangat Kurang')
                                            <option value="Sangat Kurang" selected>Sangat Kurang</option>
                                        @else
                                            <option value="Sangat Kurang">Sangat Kurang</option>
                                        @endif

                                        @if (old('nilai') == 'Tidak Membuat')
                                            <option value="Tidak Membuat" selected>Tidak Membuat</option>
                                        @else
                                            <option value="Tidak Membuat">Tidak Membuat</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group @error('awal_tgl_berlaku')has-error @enderror">
                                    <label>Awal Berlaku Pengurangan <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="awal_tgl_berlaku" name="awal_tgl_berlaku" value="{{ old('awal_tgl_berlaku') }}">
                                </div>

                                <div class="form-group @error('akhir_tgl_berlaku')has-error @enderror">
                                    <label>Akhir Berlaku Pengurangan <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="akhir_tgl_berlaku" name="akhir_tgl_berlaku" value="{{ old('akhir_tgl_berlaku') }}">
                                </div>

                                <div class="form-group @error('bukti')has-error @enderror">
                                    <label>Upload Bukti </label>
                                    <input class="form-control fileClass" type="file" id="bukti"
                                        name="bukti">
                                    <em>Silakan upload file Bukti (jpg/jpeg/png/pdf max 2Mb)</em>
                                </div>

                            </div>
                        </div>

                        <a href="{{ route('pegawai-penilaian-kinerja.index') }}">
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
        $('#tw').select2({
            width: 'resolve'
        });

        $('#tahun_nilai').select2({
            width: 'resolve'
        });

        $('#nilai').select2({
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
