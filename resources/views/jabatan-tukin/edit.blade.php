@extends('template')

@push('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jabatan-tukin.index') }}"><i class="fa fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Jabatan Tukin</a></li>        
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
@endpush

@section('content')
    <div class="section-body">
        <div class="col-12">
            <div class="box-content card white">
                <div class="card-content">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="post"  action="{{ route('jabatan-tukin.update',$jabatanTukin->id) }}"  accept-charset="utf-8">
                        @csrf
                        
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Jabatan Id<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"  id="jabatan_id" name = "jabatan_id" value = "{{ old('jabatan_id') ?? $jabatanTukin->jabatan_id }}" maxlength = "{0}" placeholder="Jabatan Id" autocomplete="off"></input>                                            
                                </div>
                            </div>
                        </div>
                            
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Jenis Jabatan Id<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"  id="jenis_jabatan_id" name = "jenis_jabatan_id" value = "{{ old('jenis_jabatan_id') ?? $jabatanTukin->jenis_jabatan_id }}" maxlength = "{0}" placeholder="Jenis Jabatan Id" autocomplete="off"></input>                                            
                                </div>
                            </div>
                        </div>
                            
                        <div class="row clearfix">
                            <div class="col-12 col-lg-12 col-md-12">
                                <div class="form-group ">
                                    <label>Tukin Id<span class="text-danger"><sup>*</sup></span></label>
                                    <input class="form-control"  id="tukin_id" name = "tukin_id" value = "{{ old('tukin_id') ?? $jabatanTukin->tukin_id }}" maxlength = "{0}" placeholder="Tukin Id" autocomplete="off"></input>                                            
                                </div>
                            </div>
                        </div>
                            
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Ubah</button>
                    </form>
                </div>
                <!-- /.card-content -->
            </div>
        </div>
    </div>
@endsection

