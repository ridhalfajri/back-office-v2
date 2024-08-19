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
            <li class="breadcrumb-item"><a href="{{ route('pegawai-tunjangan-keluarga.index') }}">Persetujuan Tunjangan
                    Keluarga</a>
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

                    <div class="row clearfix">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group @error('file_pengajuan_kp')has-error @enderror">
                                @if ($ptk->file_pengajuan_kp)
                                    <a href="//{{ $ptk->file_pengajuan_kp }}" target="_blank"><i
                                            class="dropdown-icon fa fa-file"></i>Download File Pengajuan Tunjangan Keluarga
                                        KP4</a>
                                @endif
                            </div>

                            <div class="form-group @error('file_kp_ttd')has-error @enderror">
                                @if ($ptk->file_kp_ttd)
                                    <a href="{{ $ptk->file_kp_ttd }}" target="_blank"><i
                                            class="dropdown-icon fa fa-file"></i>Download File KP4 yang Sudah Di-TTD</a>
                                @endif
                            </div>

                            <a href="{{ route('pegawai-tunjangan-keluarga.index') }}">
                                <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                    Kembali
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript"></script>
@endpush
