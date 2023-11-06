@extends('template')

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('golongan.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Golongan</a></li>        
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

                    <form method="post"  action="{{ route('golongan.store') }}"  accept-charset="utf-8">
                        @csrf
                        
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Nama<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="nama" name = "nama" maxlength = "{0}" placeholder="Nama" autocomplete="off"></input>                                            
                                </div>
                            </div>
                        </div>
                            
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Nama Pangkat<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="nama_pangkat" name = "nama_pangkat" maxlength = "{0}" placeholder="Nama Pangkat" autocomplete="off"></input>                                            
                                </div>
                            </div>
                        </div>
                            
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Bkn Id<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="bkn_id" name = "bkn_id" maxlength = "{0}" placeholder="Bkn Id" autocomplete="off"></input>                                            
                                </div>
                            </div>
                        </div>
                            
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
                    </form>
                </div>
                <!-- /.card-content -->
            </div>
        </div>
    </div>
@endsection

