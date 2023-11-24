@extends('layout')

@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    
@endpush

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('unit-kerja.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('unit-kerja.index') }}">Unit Kerja</a></li>
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

                    <form method="post"  action="{{ route('unit-kerja.store') }}"  accept-charset="utf-8">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group @error('nama')has-error @enderror">
                                    <label>Unit Kerja <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                        class="form-control" required="" maxlength="255" placeholder="Nama Unit Kerja"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('jenis_unit_kerja_id')has-error @enderror">
                                    <label>Jenis Unit Kerja <span class="text-danger"><sup>*</sup></span></label>
                                    <select id="jenis_unit_kerja_id" name="jenis_unit_kerja_id" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($jenisUnit as $item)
                                            @if (old('jenis_unit_kerja_id') && old('jenis_unit_kerja_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group @error('singkatan')has-error @enderror">
                                    <label>Singkatan </label>
                                    <input type="text" name="singkatan" id="singkatan" value="{{ old('singkatan') }}"
                                        class="form-control" maxlength="18" placeholder="Singkatan Unit Kerja"
                                        autocomplete="off">
                                </div>

                                <div class="form-group @error('keterangan')has-error @enderror">
                                    <label>Keterangan </label>
                                    <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan') }}"
                                        class="form-control" maxlength="100" placeholder="Keterangan Unit Kerja"
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
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript">

        $('#jenis_unit_kerja_id').select2({
            width: 'resolve'
        });

    </script>
@endpush