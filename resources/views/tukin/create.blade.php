@extends('template')

@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tukin.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('tukin.index') }}">Tunjangan Kinerja</a></li>
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

                    <form method="post"  action="{{ route('tukin.store') }}"  accept-charset="utf-8">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('grade')has-error @enderror">
                                    <label>Grade <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="grade" id="grade" value="{{ old('grade') }}"
                                        class="form-control" required="" maxlength="9999" placeholder="Grade Tunjangan Kinerja"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('nominal')has-error @enderror">
                                    <label>Nominal <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="number" name="nominal" id="nominal" value="{{ old('nominal') }}"
                                        class="form-control" required="" maxlength="9999999999" placeholder="Nominal Tunjangan Kinerja"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('keterangan')has-error @enderror">
                                    <label>Keterangan </label>
                                    <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan') }}"
                                        class="form-control" maxlength="255" placeholder="Keterangan"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

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