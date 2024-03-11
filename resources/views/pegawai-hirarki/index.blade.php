@extends('template')

@push('style')
<!-- Plugins css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

    {{-- custom css datatable --}}
{{-- <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/custom.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endpush

@push('breadcrumb')
        <ol class="breadcrumb custom-background-color">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Gaji</a></li>        -->
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <label class="form-label"><i>Filter Datatable</i></label> --}}
                    <div class="row clearfix">
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="form-group @error('unitKerja')has-error @enderror">
                                <label class="form-label">Unit Kerja</label>
                                <select id="unitKerja" name="unitKerja" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($dataUnitKerja as $data)
                                        {{-- @if (old('unitKerja') == $data->id )
                                            <option value="{{ $data->id }}" selected>{{ $data->nama }}</option>
                                        @else
                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endif --}}
                                       
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="box-title" style="text-align: center;"><b>List Hirarki Pegawai</b></h5>
                
                    <table id="tbl-data"
                    class="table table-hover js-basic-example dataTable table_custom spacing5">
                    <thead>
                        <tr>
                            <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                            <th class="font-weight-bold text-dark">Nama Staff</th>
                            <th class="font-weight-bold text-dark">Nama Pimpinan</th>
                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="font-weight-bold text-dark" style="width: 5%">No</th>
                            <th class="font-weight-bold text-dark">Nama Staff</th>
                            <th class="font-weight-bold text-dark">Nama Pimpinan</th>
                            <th class="font-weight-bold text-dark">Unit Kerja</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<!-- Data Tables -->
    
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
   
    <script type="text/javascript">
        "use strict"
        let table;

        $(function() {
            $('#unitKerja').select2({
                width: 'resolve'
            });


            table = $('#tbl-data').DataTable({
                processing: true,
                destroy: true,
                serverSide: true,
                deferRender: true,
                responsive: true,
                pageLength: 10,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pegawai-hirarki.datatable') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function(d) {
                        //untuk on change datatable
                        d.unitKerja = $('#unitKerja').val();
                    }
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_staff',
                        name: 'nama_staff',
                        class: 'text-center'
                    },
                    {
                        data: 'nama_pimpinan',
                        name: 'nama_pimpinan',
                        class: 'text-center'
                    },
                    {
                        data: 'unit_kerja',
                        name: 'uk.nama',
                        class: 'text-center'
                    },
                ],
                columnDefs: [{
                    'sortable': false,
                    'searchable': false,
                    'targets': [0, -1]
                }],
                order: [
                    [1, 'asc']
                ]
            });

            table.on('draw.dt', function() {
                var info = table.page.info();
                table.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            });

            //untuk on change
            $('#unitKerja').change(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

    })

</script>
@endpush

