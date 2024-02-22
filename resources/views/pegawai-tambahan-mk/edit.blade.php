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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-tambahan-mk.index') }}">Approval Tambahan Masa Kerja Pegawai</a>
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
                        action="{{ route('pegawai-tambahan-mk.update', $pmk->id) }}" accept-charset="utf-8"
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

                                <div class="form-group @error('tahun_plus_disetujui')has-error @enderror">
                                    <label>Total Tahun Disetujui <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="tahun_plus_disetujui" id="tahun_plus_disetujui" value="{{ old('tahun_plus_disetujui') ?? $pmk->tahun_plus_disetujui }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total tahun disetujui"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('bulan_plus_disetujui')has-error @enderror">
                                    <label>Total Bulan Disetujui <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="bulan_plus_disetujui" id="bulan_plus_disetujui" value="{{ old('bulan_plus_disetujui') ?? $pmk->bulan_plus_disetujui }}"
                                        class="form-control" required="" maxlength="100" placeholder="Total bulan disetujui"
                                        autocomplete="off">
                                </div>

                                {{-- tanggal_sk --}}
                                <div class="form-group @error('tanggal_sk')has-error @enderror">
                                    <label>Tanggal SK <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="date" data-date-format="YYYY MMMM DD" class="form-control floating"
                                        id="tanggal_sk" name="tanggal_sk" value="{{ old('tanggal_sk') ?? $pmk->tanggal_sk }}">
                                </div>

                                {{-- no_sk --}}
                                <div class="form-group @error('no_sk')has-error @enderror">
                                    <label>No. SK <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="no_sk" id="no_sk" value="{{ old('no_sk') ?? $pmk->no_sk }}"
                                        class="form-control" required="" maxlength="50" placeholder="No SK PMK"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('pejabat_penetap')has-error @enderror">
                                    <label>Pejabat Penetap <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="pejabat_penetap" id="pejabat_penetap" value="{{ old('pejabat_penetap') ?? $pmk->pejabat_penetap }}"
                                        class="form-control" required="" maxlength="255" placeholder="Pejabat penetap SK"
                                        autocomplete="off">
                                </div>

                                {{-- file_sk_pmk  --}}
                                <div class="form-group @error('file_sk_pmk')has-error @enderror">
                                    <label>Upload File SK <span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control fileClass" type="file" id="file_sk_pmk"
                                        name="file_sk_pmk">
                                    <em>Silakan upload file sk (pdf/doc/docx max 2Mb)</em>
                                    <br>
                                    @if ($pmk->file_sk_pmk)
                                        <a href="//{{ $pmk->file_sk_pmk }}" target="_blank">Lihat File SK</a>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <a href="{{ route('pegawai-tambahan-mk.index') }}">
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
                                text: 'Apakah anda yakin ingin setujui pengajuan PMK?',
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
                                    swal('Informasi', 'Menyetujui PMK dibatalkan', 'error');
                                    event.stopPropagation()
                                }
                            });
                        }
                    }, false)
                });
        })();
    </script>
@endpush
