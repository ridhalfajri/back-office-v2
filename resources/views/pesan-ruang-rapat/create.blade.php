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
            <li class="breadcrumb-item"><a href="{{ route('pesan-ruang-rapat.index') }}">Pesanan Ruang Rapat</a>
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

                    <form class="needs-validation" id="form-atg" method="post"
                        action="{{ route('pesan-ruang-rapat.store') }}" accept-charset="utf-8"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('nama_rapat')has-error @enderror">
                                    <label>Nama Rapat <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama_rapat" id="nama_rapat" value="{{ old('nama_rapat') }}"
                                        class="form-control" placeholder="Nama Rapat"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('ruang_rapat_id')has-error @enderror">
                                    <label>Ruang Rapat <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="ruang_rapat_id" name="ruang_rapat_id" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($dataRuangRapat as $item)
                                            @if (old('ruang_rapat_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('tanggal')has-error @enderror">
                                    <label>Tanggal <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                                </div>

                                <div class="form-group @error('waktu_mulai')has-error @enderror">
                                    <label>Waktu Mulai <span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type = "time" id="waktu_mulai" name = "waktu_mulai"
                                        value="{{ old('waktu_mulai') }}" placeholder="Waktu Mulai" autocomplete="off"/>
                                </div>
                                
                                <div class="form-group @error('waktu_selesai')has-error @enderror">
                                    <label>Waktu Selesai <span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" type = "time" id="waktu_selesai" name = "waktu_selesai"
                                        value="{{ old('waktu_selesai') }}" placeholder="Waktu Selesai" autocomplete="off"/>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('pesan-ruang-rapat.index') }}">
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
        $('#ruang_rapat_id').select2({
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
