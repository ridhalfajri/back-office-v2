@extends('template')

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('uang-makan.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Uang Makan</a></li>        
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
<<<<<<< HEAD
        <div class="card">
            <div class="card-body">
=======
        <div class="col-12">
            <div class="box-content card white">
>>>>>>> ed1664d2036b11bb4c635d440d6447a19a5c0964
                <div class="card-content">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="post"  action="{{ route('uang-makan.store') }}"  accept-charset="utf-8">
                        @csrf
                        
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Golongan Id<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="golongan_id" name = "golongan_id" maxlength = "{0}" placeholder="Golongan Id" autocomplete="off"></input>                                            
                                </div>
                            </div>
                        </div>
                            
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Nominal<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control" id="nominal" name = "nominal" maxlength = "{0}" placeholder="Nominal" autocomplete="off"></input>                                            
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

