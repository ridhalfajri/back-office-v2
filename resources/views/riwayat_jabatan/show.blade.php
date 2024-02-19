@extends('template')
@push('style')
@endpush
@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold ">Detail Jabatan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">Nama</label>
                        <p>{{ $jabatan->pegawai->nama }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">NIP</label>
                        <p>{{ $jabatan->pegawai->nip }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">Unit Kerja</label>
                        <p>{{ $jabatan->pegawai->jabatan_sekarang->jabatan_unit_kerja->hirarki_unit_kerja->child->nama }}
                        </p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">Jabatan</label>
                        <p>{{ $jabatan->pegawai->jabatan_sekarang->tipe_jabatan->tipe_jabatan }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">No SK</label>
                        <p>{{ $jabatan->no_sk }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">No Pelantikan</label>
                        <p>{{ $jabatan->no_pelantikan }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">Tanggal SK</label>
                        <p>{{ Carbon\Carbon::parse($jabatan->tanggal_sk)->translatedFormat('d/m/Y') }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">Tanggal Pelantikan</label>
                        <p>{{ Carbon\Carbon::parse($jabatan->tanggal_pelantikan)->translatedFormat('d/m/Y') }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">TMT Jabatan</label>
                        <p>{{ Carbon\Carbon::parse($jabatan->tmt_jabatan)->translatedFormat('d/m/Y') }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">Pejabatan Penetap</label>
                        <p>{{ $jabatan->pejabat_penetap }}</p>
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">PLT</label>
                        @if ($jabatan->is_plt)
                            <p>AKTIF</p>
                        @else
                            <p>TIDAK AKTIF</p>
                        @endif
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label class="form-label">Status Jabatan</label>
                        @if ($jabatan->is_now)
                            <p>AKTIF</p>
                        @else
                            <p>TIDAK AKTIF</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">File SK</label>
                        <a href="{{ $jabatan->media_sk_jabatan }}" id="" class="btn btn-primary">Download</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- SweetAlert --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endpush
