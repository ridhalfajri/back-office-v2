@extends('template')
@push('style')
@endpush
@push('breadcrumb')
    <ol class="breadcrumb custom-background-color">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('penghasilan.show', $cekPeriodUmak->pegawai_id) }}">Detail THP
                Pegawai</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="section-body  py-4">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $umakPeriode }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row my-8">
                                        <div class="col-6">
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="h3">Pegawai</p>
                                            <address>
                                                {{ $umak->nama_depan . ' ' . $umak->nama_belakang }}<br>
                                                {{ $umak->nip }}<br>
                                                {{ $umak->email_kantor }}<br>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="table-responsive push">
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <th class="text-center width35"></th>
                                                <th>Keterangan</th>
                                                <th class="text-center" style="width: 20%">Nominal</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>
                                                    <p class="font600 mb-1">Uang Makan</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($umak->nominal, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">2</td>
                                                <td>
                                                    <p class="font600 mb-1">Jumlah Masuk Hari Kerja</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ $umak->jumlah_hari_masuk }}
                                                </td>
                                            </tr>
                                            <tr class="bg-green text-light">
                                                <td colspan="2" class="font700 text-right">Total Pendapatan Uang Makan
                                                </td>
                                                <td class="font700 text-right">
                                                    {{ 'Rp ' . number_format($umak->total, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- Multiselect --}}
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/table/datatable.js') }}"></script>
    <script>
        "use strict"
    </script>
@endpush
