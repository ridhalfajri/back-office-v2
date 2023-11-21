@extends('template')
@push('style')
@endpush
@section('content')
    <div class="col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold ">DATA PEGAWAI</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-lg-6">
                        <label class="form-label">Nama</label>
                        <p>{{ $cuti->pegawai->nama }}</p>
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                        <label class="form-label">NIP</label>
                        <p>{{ $cuti->pegawai->nip }}</p>
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                        <label class="form-label">Unit Kerja</label>
                        <p>{{ $cuti->pegawai->jabatan_sekarang->jabatan_unit_kerja->hirarki_unit_kerja->child->nama }}</p>
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                        <label class="form-label">Jabatan</label>
                        <p>{{ $cuti->pegawai->jabatan_sekarang->tipe_jabatan->tipe_jabatan }}</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-header">
                <h3 class="card-title font-weight-bold">FORM PENGAJUAN CUTI</h3>
            </div>
            <input type="hidden" value="{{ $cuti->id }}" name="cuti_id" id="cuti_id">
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Jenis Cuti Yang Diambil</label>
                    <input type="text" class="form-control" placeholder="Jenis Cuti"
                        value="{{ $cuti->jenis_cuti->jenis }}" disabled>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-lg-6">
                        <label class="form-label">Tanggal Cuti</label>
                        <input type="text" class="form-control" placeholder="Tanggal Cuti"
                            value="{{ $cuti->tanggal_awal_cuti . ' - ' . $cuti->tanggal_akhir_cuti }}" disabled>
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                        <label class="form-label">Lama Cuti</label>
                        <input type="text" class="form-control" placeholder="Lama Cuti" value="{{ $cuti->lama_cuti }}"
                            disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon yang Bisa Dihubungi Selama Cuti</label>
                    <input type="number" class="form-control" placeholder="No Telp" value="{{ $cuti->no_telepon_cuti }}"
                        disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Alasan Lengkap Cuti</label>
                    <textarea class="form-control" id="alasan" name="alasan" placeholder="Alasan Cuti" disabled>{{ $cuti->alasan }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat / Lokasi Selama Menjalankan Cuti</label>
                    <textarea class="form-control" id="alamat_cuti" name="alamat_cuti" placeholder="Alamat Cuti" disabled>{{ $cuti->alamat_cuti }}</textarea>
                    <small class="text-danger" id="error_alamat_cuti"></small>
                </div>
                @if ($cuti->media_pengajuan_cuti != null)
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label class="form-label">Lampiran <small class="text-danger">(jika diperlukan, misal : Surat
                                Keterangan Sakit, dll)</small></label>
                        <a href="//{{ $cuti->media_pengajuan_cuti }}" class="btn btn-success">Download</a>
                    </div>
                @endif
                <div class="form-group">
                    <label class="form-label">Acc Atasan Langsung</label>
                    <input type="text" class="form-control" placeholder="Atasan Langsung"
                        value="{{ $cuti->atasan_langsung->nama }}" disabled>
                    <small class="text-danger" id="error_alamat_cuti"></small>
                </div>
            </div>
            <div class="card-header">
                <h3 class="card-title">Saldo Cuti</h3>
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
            <div class="card-footer d-flex justify-content-end">
                @if ($cuti->status_pengajuan_cuti_id == 2)
                    <button type="button" class="btn btn-danger px-5 mx-4">Tolak</button>
                    <button type="button" onclick="acc_kabiro_sdmoh()" class="btn btn-primary px-5">Terima</button>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- SweetAlert --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        "use strict"
        const acc_kabiro_sdmoh = () => {
            const id = $('#cuti_id').val()
            Swal.fire({
                title: "Apakah anda yakin terima cuti ini?",
                showCancelButton: true,
                icon: 'question',
                confirmButtonText: "Terima",
                cancelButtonText: "Batal",
                cancelButtonColor: "#DC3444",
                confirmButtonColor: "#017BFE",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('cuti.acc-kabiro-sdmoh') }}',
                        data: {
                            id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.errors) {
                                if (response.errors.data) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.errors.data,
                                        icon: 'error',
                                        confirmButtonText: 'Tutup'
                                    })
                                }
                                if (response.errors.connection) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.errors.connection,
                                        icon: 'error',
                                        confirmButtonText: 'Tutup'
                                    })
                                }
                            } else {
                                Swal.fire({
                                    title: 'Tersimpan!',
                                    text: response.success,
                                    icon: 'success',
                                    confirmButtonText: 'Tutup'
                                })
                            }
                            setTimeout(function() {
                                window.location.href =
                                    '{{ route('cuti.pengajuan-masuk-sdmoh') }}'
                            }, 1000);
                        }
                    });
                }
            });

        }
    </script>
@endpush
