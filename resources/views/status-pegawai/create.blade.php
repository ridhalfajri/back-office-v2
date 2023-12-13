@extends('template')

@push('style')
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

                    <form method="post"  action="{{ route('status-pegawai.store') }}"  accept-charset="utf-8">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Status Pegawai <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                        class="form-control" required="" maxlength="30" placeholder="Nama Status Pegawai"
                                        autocomplete="off">
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
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        "use strict"

        // $('#golongan_id').select2({
        //         width: 'resolve'
        // });

    </script>
@endpush