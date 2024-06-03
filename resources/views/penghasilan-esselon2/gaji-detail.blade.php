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
                                    <h3 class="card-title">{{ $gaji->periode }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row my-8">
                                        <div class="col-6">
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="h3">Pegawai</p>
                                            <address>
                                                {{ $gaji->nama_depan . ' ' . $gaji->nama_belakang }}<br>
                                                {{ $gaji->nip }}<br>
                                                {{ $gaji->email_kantor }}<br>
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
                                                    <p class="font600 mb-1">Gaji Pokok</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->nominal_gaji_pokok, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td>
                                                    <p class="font600 mb-1">Tunjangan Beras</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->tunjangan_beras, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td>
                                                    <p class="font600 mb-1">Tunjangan Pasangan</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->tunjangan_pasangan, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4</td>
                                                <td>
                                                    <p class="font600 mb-1">Tunjangan Anak</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->tunjangan_anak, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5</td>
                                                <td>
                                                    <p class="font600 mb-1">Tunjangan Jabatan</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->tunjangan_jabatan, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6</td>
                                                <td>
                                                    <p class="font600 mb-1">Tunjangan Pajak</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->tunjangan_pajak, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">7</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan Simpanan Wajib</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->potongan_simpanan_wajib, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">8</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan IWP</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->potongan_iwp, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">8</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan BPJS</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->potongan_bpjs, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">8</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan BPJS Lainnya</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->potongan_bpjs_lainnya, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">8</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan Pajak</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->potongan_pajak, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-center">8</td>
                                                <td>
                                                    <p class="font600 mb-1">Potongan Tapera</p>
                                                </td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->potongan_tapera, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="font600 text-right">Total Tunjangan + Gaji</td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->total_tunjangan, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td colspan="2" class="font600 text-right">Total Potongan</td>
                                                <td class="text-right">
                                                    {{ 'Rp ' . number_format($gaji->total_potongan, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="bg-green text-light">
                                                <td colspan="2" class="font700 text-right">Total Pendapatan</td>
                                                <td class="font700 text-right">
                                                    {{ 'Rp ' . number_format($gaji->total_pendapatan, 0, ',', '.') }}</td>
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
