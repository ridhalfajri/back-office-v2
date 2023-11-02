@extends('template')
@push('style')
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    {{-- File Upload --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}">
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Riwayat Diklat</h3>
                        </div>
                        <form id="form-create" action="" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Pegawai</label>
                                        <input type="text" class="form-control" value="{{ $pegawai->nama }}"
                                            placeholder="Nama Pegawai" disabled>
                                    </div>
                                    <div class="form-group multiselect_div col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Jenis Diklat</label>
                                        <select id="jenis_diklat_id" name="jenis_diklat_id"
                                            class="select-filter multiselect multiselect-custom">
                                            <option value="">-- Pilih Jenis Diklat--</option>
                                            @foreach ($jenis_diklat as $item)
                                                <option value="$item->id">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="error_propinsi_id"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label>Range</label>
                                        <div class="input-daterange input-group" data-provide="datepicker">
                                            <input type="text" class="input-sm form-control" id="tanggal_mulai"
                                                name="start">
                                            <span class="input-group-addon range-to px-3">to</span>
                                            <input type="text" class="input-sm form-control" id="tanggal_akhir"
                                                name="end">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Jam Pelajaran</label>
                                        <input type="number" class="form-control" id="jam_pelajaran" name="jam_pelajaran"
                                            placeholder="Jam Pelajaran">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi"
                                            placeholder="Lokasi">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Penyelenggara</label>
                                        <input type="text" class="form-control" id="penyelenggaran" name="penyelenggaran"
                                            placeholder="Penyelenggara">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">No Sertifikat</label>
                                        <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat"
                                            placeholder="No Sertifikat">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Tanggal Sertifikat</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tanggal_sertifikat"
                                                data-date-autoclose="true" data-date-format="dd/mm/yyyy"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">File Sertifikat</label>
                                        <div class="input-group">
                                            <input type="file" id="file_sertifikat">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <a href="{{ route('pegawai.show', $pegawai->id) }}" type="button"
                                    class="btn btn-secondary mr-2">Batal</a>
                                <button id="store-diklat" type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
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
    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- File Upload --}}
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    {{-- Sweetalert2 --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
    </script>
    <script>
        $('.dropify').dropify();

        var drEvent = $('#file_sertifikat').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {});

        drEvent.on('dropify.afterClear', function(event, element) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'File berhasil dihapus!',
                showConfirmButton: false,
                timer: 1500
            })
        });

        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
    </script>
@endpush
