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
                            <h3 class="card-title">Tambah Anak</h3>
                        </div>
                        <form id="form-edit" action="{{ route('anak.update', $anak->id) }}" method="POST"
                            autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Pegawai</label>
                                        <input type="text" class="form-control"
                                            value="{{ $anak->pegawai->nama_depan . ' ' . $anak->pegawai->nama_belakang }}"
                                            placeholder="Nama Pegawai" disabled>
                                        <input type="hidden" name="pegawai_id" id="pegawai_id"
                                            value="{{ $anak->pegawai_id }}">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Anak</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Anak" value="{{ $anak->nama }}">
                                        <small class="text-danger" id="error_nama"></small>

                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Anak ke</label>
                                        <input type="number" id="anak_ke" name="anak_ke" oninput="limitDigits(this, 2);"
                                            class="form-control state-valid" placeholder="Anak Ke"
                                            value="{{ $anak->anak_ke }}">
                                        <small class="text-danger" id="error_anak_ke"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">NIK</label>
                                        <input type="number" id="nik" name="nik" oninput="limitDigits(this, 16);"
                                            class="form-control state-valid" value="{{ $anak->nik }}" placeholder="NIK">
                                        <small class="text-danger" id="error_nik"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Tempat Lahir" value="{{ $anak->tempat_lahir }}">
                                        <small class="text-danger" id="error_tempat_lahir"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tanggal_lahir" name="tanggal_lahir"
                                                data-date-autoclose="true" placeholder="Tanggal Lahir"
                                                data-date-format="dd/mm/yyyy" class="form-control datepicker"
                                                value="{{ $anak->tanggal_lahir }}">
                                        </div>
                                        <small class="text-danger" id="error_tanggal_lahir"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Status Anak</label>
                                        <select class="form-control custom-select" name="status_anak">
                                            <option value="">-- Pilih Status Anak--</option>
                                            <option value="Kandung" @if ($anak->status_anak == 'Kandung') selected @endif>
                                                Kandung</option>
                                            <option value="Angkat" @if ($anak->status_anak == 'Angkat') selected @endif>Angkat
                                            </option>
                                        </select>
                                        <small class="text-danger" id="error_status_anak"></small>

                                    </div>
                                    <div class="form-group multiselect_div col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Pendidikan</label>
                                        <select id="pendidikan_id" name="pendidikan_id"
                                            class="select-filter multiselect multiselect-custom">
                                            <option value="">-- Pilih Pendidikan--</option>
                                            @foreach ($pendidikan as $item)
                                                @if ($item->id == $anak->pendidikan_id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="error_pendidikan_id"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Bidang Studi</label>
                                        <input type="text" class="form-control" id="bidang_studi" name="bidang_studi"
                                            placeholder="bidang_studi" value="{{ $anak->bidang_studi }}">
                                        <small class="text-danger" id="error_bidang_studi"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Status Tunjangan</label>
                                        <select class="form-control custom-select" name="status_tunjangan">
                                            <option value="">-- Pilih Status Tunjangan--</option>
                                            <option value="1" @if ($anak->status_tunjangan == '1') selected @endif>Aktif
                                            </option>
                                            <option value="0" @if ($anak->status_tunjangan == '0') selected @endif>Non
                                                Aktif</option>
                                        </select>
                                        <small class="text-danger" id="error_status_tunjangan"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <a href="{{ route('pegawai.show', $anak->pegawai_id) }}" type="button"
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
                        if (err.pendidikan_id) {
                            $('#error_pendidikan_id').text(err.pendidikan_id)
                        }
                        if (err.nama) {
                            $('#error_nama').text(err.nama)
                        }
                        if (err.nik) {
                            $('#error_nik').text(err.nik)
                        }
                        if (err.tempat_lahir) {
                            $('#error_tempat_lahir').text(err.tempat_lahir)
                        }
                        if (err.tanggal_lahir) {
                            $('#error_tanggal_lahir').text(err.tanggal_lahir)
                        }
                        if (err.anak_ke) {
                            $('#error_anak_ke').text(err.anak_ke)
                        }
                        if (err.status_anak) {
                            $('#error_status_anak').text(err.status_anak)
                        }
                        if (err.bidang_studi) {
                            $('#error_bidang_studi').text(err.bidang_studi)
                        }
                        if (err.status_tunjangan) {
                            $('#error_status_tunjangan').text(err.status_tunjangan)
                        }
                        if (err.connection) {
                            Swal.fire({
                                title: 'Gagal!',
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
                        setTimeout(function() {
                            window.location.href = '/pegawai/' + $('#pegawai_id').val()
                        }, 1000);

                    }
                }
            });
        });

        function resetForm(is_success = false) {
            $('#error_pendidikan_id').text('')
            $('#error_nama').text('')
            $('#error_nik').text('')
            $('#error_tempat_lahir').text('')
            $('#error_tanggal_lahir').text('')
            $('#error_anak_ke').text('')
            $('#error_status_anak').text('')
            $('#error_bidang_studi').text('')
            $('#error_status_tunjangan').text('')
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

        const drEvent = $('#media_foto_pasangan').dropify();
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

        const buku_nikah = $('#media_buku_nikah').dropify();
        buku_nikah.on('dropify.beforeClear', function(event, element) {});

        buku_nikah.on('dropify.afterClear', function(event, element) {
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
