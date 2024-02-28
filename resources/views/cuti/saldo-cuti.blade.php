@extends('template')
@push('style')
@endpush
@push('breadcrumb')
    <ol class="breadcrumb custom-background-color">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
@endpush
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Saldo Cuti Saya</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <table border="1" class="table text-center text-dark">
                                    <tr style="background-color: #E9ECEF;" class="font-weight-bold">
                                        <th class="text-dark font-weight-bold">No</th>
                                        <th class="text-dark font-weight-bold">Jenis Cuti</th>
                                        <th class="text-dark font-weight-bold" colspan="3">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">1</td>
                                        <td rowspan="5" class="font-weight-bold">Cuti Tahunan</td>
                                        <td>Tahun</td>
                                        <td>Sisa</td>
                                        <td>Keterangan</td>
                                    </tr>
                                    <tr>
                                        <td>N-2</td>
                                        <td>{{ $saldo_cuti->saldo_n_2 }}</td>
                                        <td>{{ Carbon\Carbon::now()->format('Y') - 2 }}</td>
                                    </tr>
                                    <tr>
                                        <td>N-1</td>
                                        <td>{{ $saldo_cuti->saldo_n_1 }}</td>
                                        <td>{{ Carbon\Carbon::now()->format('Y') - 1 }}</td>
                                    </tr>
                                    <tr>
                                        <td>N</td>
                                        <td>{{ $saldo_cuti->saldo_n }}</td>
                                        <td>{{ Carbon\Carbon::now()->format('Y') }}</td>
                                    </tr>
                                    <tr style="background-color: #E9ECEF;" class="font-weight-bold">
                                        <td>Total</td>
                                        <td>{{ $saldo_cuti->saldo_n_2 + $saldo_cuti->saldo_n_1 + $saldo_cuti->saldo_n }}
                                        </td>
                                        <td>Total Sisa Cuti</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="font-weight-bold">Cuti Besar</td>
                                        <td colspan="3">Tersedia</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="font-weight-bold">Cuti Sakit</td>
                                        <td colspan="3">Tersedia</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td class="font-weight-bold">Cuti Melahirkan</td>
                                        <td colspan="3">Tersedia</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td class="font-weight-bold">Cuti Karena Alasan Penting</td>
                                        <td colspan="3">Tersedia</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td class="font-weight-bold">Cuti Di Luar Tanggungan Negara</td>
                                        <td colspan="3">Tersedia</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
