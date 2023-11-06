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
                        <form id="form-edit" action="{{ route('diklat.update', $diklat->id) }}"
                            enctype="multipart/form-data" method="POST" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Pegawai</label>
                                        <input type="text" class="form-control"
                                            value="{{ $diklat->pegawai->nama_depan }}" placeholder="Nama Pegawai" disabled>
                                        <input type="hidden" name="pegawai_id" id="pegawai_id"
                                            value="{{ $diklat->pegawai_id }}">
                                    </div>
                                    <div class="form-group multiselect_div col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Jenis Diklat</label>
                                        <select id="jenis_diklat_id" name="jenis_diklat_id"
                                            class="select-filter multiselect multiselect-custom">
                                            <option value="">-- Pilih Jenis Diklat--</option>
                                            @foreach ($jenis_diklat as $item)
                                                @if ($item->id == $diklat->jenis_diklat_id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="error_jenis_diklat_id"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label>Range</label>
                                        <div class="input-daterange input-group" data-provide="datepicker">
                                            <input type="text" class="input-sm form-control datepicker"
                                                id="tanggal_mulai" name="tanggal_mulai"
                                                value="{{ $diklat->tanggal_mulai }}">
                                            <span class="input-group-addon range-to px-3">to</span>
                                            <input type="text" class="input-sm form-control datepicker"
                                                id="tanggal_akhir" name="tanggal_akhir"
                                                value="{{ $diklat->tanggal_akhir }}">
                                        </div>
                                        <small class="text-danger" id="error_tanggal_mulai"></small>
                                        <small class="text-danger" id="error_tanggal_akhir"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Jam Pelajaran</label>
                                        <input type="number" id="jam_pelajaran" min="0" step="0.01"
                                            oninput="limitDigits(this, 3);" class="form-control state-valid"
                                            value="{{ $diklat->jam_pelajaran }}" name="jam_pelajaran"
                                            placeholder="Jam Pelajaran">
                                        <small class="text-danger" id="error_jam_pelajaran"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Lokasi</label>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi"
                                            placeholder="Lokasi" value="{{ $diklat->lokasi }}">
                                        <small class="text-danger" id="error_lokasi"></small>

                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Penyelenggara</label>
                                        <input type="text" class="form-control" id="penyelenggaran" name="penyelenggaran"
                                            placeholder="Penyelenggara" value="{{ $diklat->penyelenggaran }}">
                                        <small class="text-danger" id="error_penyelenggaran"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">No Sertifikat</label>
                                        <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat"
                                            placeholder="No Sertifikat" value="{{ $diklat->no_sertifikat }}">
                                        <small class="text-danger" id="error_no_sertifikat"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Tanggal Sertifikat</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tanggal_sertifikat"
                                                name="tanggal_sertifikat" data-date-autoclose="true"
                                                data-date-format="dd/mm/yyyy" class="form-control datepicker"
                                                value="{{ $diklat->tanggal_sertifikat }}">
                                        </div>
                                        <small class="text-danger" id="error_tanggal_sertifikat"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">File Sertifikat</label>
                                        <div class="input-group">
                                            <input type="file" id="media_sertifikat" name="media_sertifikat">
                                            <small class="text-danger" id="error_media_sertifikat"></small>
                                            <a href='//{{ $diklat->media_sertifikat->getUrl() }}'+>File Sekarang :
                                                {{ $diklat->media_sertifikat->file_name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <a href="{{ route('pegawai.show', $diklat->pegawai_id) }}" type="button"
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
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $('#form-edit').submit(function(e) {
            e.preventDefault();
            const form = $(this);
            const actionUrl = form.attr('action');
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.errors) {
                        resetForm()
                        const err = response.errors
                        if (err.jenis_diklat_id) {
                            $('#error_jenis_diklat_id').text(err.jenis_diklat_id)
                        }
                        if (err.tanggal_mulai) {
                            $('#error_tanggal_mulai').text(err.tanggal_mulai)
                        }
                        if (err.tanggal_akhir) {
                            $('#error_tanggal_akhir').text(err.tanggal_akhir)
                        }
                        if (err.lokasi) {
                            $('#error_lokasi').text(err.lokasi)
                        }
                        if (err.jam_pelajaran) {
                            $('#error_jam_pelajaran').text(err.jam_pelajaran)
                        }
                        if (err.media_sertifikat) {
                            $('#error_media_sertifikat').text(err.media_sertifikat)
                        }
                        if (err.tanggal_sertifikat) {
                            $('#error_tanggal_sertifikat').text(err.tanggal_sertifikat)
                        }
                        if (err.no_sertifikat) {
                            $('#error_no_sertifikat').text(err.no_sertifikat)
                        }
                        if (err.pegawai_id) {
                            $('#error_pegawai_id').text(err.pegawai_id)
                        }
                        if (err.penyelenggaran) {
                            $('#error_penyelenggaran').text(err.penyelenggaran)
                        }
                        if (err.connection) {
                            Swal.fire({
                                title: 'Gagal!',
                                text: response.errors.connection,
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            })
                        }
                    } else if (response.success) {
                        Swal.fire({
                            title: 'Tersimpan!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Tutup'
                        })
                        setTimeout(function() {
                            window.location.href = '/pegawai/' + $('#pegawai_id').val()
                        }, 1000);

                    }
                }
            });
        });

        function resetForm(is_success = false) {
            $('#error_jenis_diklat_id').text('')
            $('#error_tanggal_mulai').text('');
            $('#error_tanggal_akhir').text('')
            $('#error_jam_pelajaran').text('');
            $('#error_lokasi').text('');
            $('#error_penyelenggaran').text('');
            $('#error_no_sertifikat').text('');
            $('#error_tanggal_sertifikat').text('');
            $('#error_media_sertifikat').text('');
        }
    </script>
    <script>
        // {{-- Limit Kode Pos --}}

        function limitDigits(input, maxDigits) {
            const value = input.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters
            const parts = value.split('.');

            if (parts[0].length > maxDigits) {
                parts[0] = parts[0].slice(0, maxDigits);
            }

            if (parts[1] && parts[1].length > 2) { // Enforce a maximum of 2 decimal places
                parts[1] = parts[1].slice(0, 2);
            }

            input.value = parts.join('.');
        }

        $('.dropify').dropify();

        const drEvent = $('#media_sertifikat').dropify();
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
