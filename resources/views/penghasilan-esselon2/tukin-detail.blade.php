@extends('template')
@push('style')
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
                                    <h3 class="card-title">{{ $tukin->periode }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row my-8">
                                        <div class="col-6">
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="h3">Pegawai</p>
                                            <address>
                                                {{ $tukin->nama_depan . ' ' . $tukin->nama_belakang }}<br>
                                                {{ $tukin->nip }}<br>
                                                {{ $tukin->email_kantor }}<br>
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
                                                    <p class="font600 mb-1">Tunjangan Kinerja</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($tukin->tunjangan_kinerja, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>
                                                    <p class="font600 mb-1">Tunjangan Kinerja Plt</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($tukin->tunjangan_kinerja_plt, 2, ',', '.') }}</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">3</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan Presensi</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($tukin->potongan_tukin, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">4</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan Kinerja</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($tukin->potongan_tukin_kinerja, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-green text-light">
                                                <td colspan="2" class="font700 text-right">Total Pendapatan Tunjangan
                                                    Kinerja</td>
                                                <td class="font700 text-right">
                                                    {{ 'Rp ' . number_format($tukin->tunjangan_kinerja + $tukin->tunjangan_kinerja_plt - $tukin->potongan_tukin - $tukin->potongan_tukin_kinerja, 2, ',', '.') }}
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
