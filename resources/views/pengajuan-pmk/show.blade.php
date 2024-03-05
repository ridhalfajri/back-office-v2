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
            <li class="breadcrumb-item"><a href="{{ route('pengajuan-pmk.index') }}">Pengajuan Peninjauan Masa Kerja</a>
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
                            <div class="form-group @error('file_sk_pmk')has-error @enderror">
                                @if ($pmk->file_sk_pmk)
                                    <a href="//{{ $pmk->file_sk_pmk }}" target="_blank"><i class="dropdown-icon fa fa-file"></i>Download File SK</a>
                                @endif
                            </div>

                            <div class="form-group @error('file_pengajuan_pmk')has-error @enderror">
                                @if ($pmk->file_pengajuan_pmk)
                                    <a href="//{{ $pmk->file_pengajuan_pmk }}" target="_blank"><i class="dropdown-icon fa fa-file"></i>Download File Pengajuan PMK</a>
                                @endif
                            </div>

                            <a href="{{ route('pengajuan-pmk.index') }}">
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

    <script type="text/javascript">
        
    </script>
@endpush
