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
                            <h3 class="card-title">Edit Pasangan</h3>
                        </div>
                        <form id="form-edit" action="{{ route('pasangan.update', $pasangan->id) }}" method="POST"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Pegawai</label>
                                        <input type="text" class="form-control"
                                            value="{{ $pasangan->pegawai->nama_depan . ' ' . $pasangan->pegawai->nama_belakang }}"
                                            placeholder="Nama Pegawai" disabled>
                                        <input type="hidden" name="pegawai_id" id="pegawai_id"
                                            value="{{ $pasangan->pegawai_id }}">
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Pasangan</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Pasangan" value="{{ $pasangan->nama }}">
                                        <small class="text-danger" id="error_nama"></small>

                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">NIK</label>
                                        <input type="number" id="nik" name="nik" oninput="limitDigits(this, 16);"
                                            class="form-control state-valid" value="{{ $pasangan->nik }}" placeholder="NIK">
                                        <small class="text-danger" id="error_nik"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Tempat Lahir" value="{{ $pasangan->tempat_lahir }}">
                                        <small class="text-danger" id="error_tempat_lahir"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tanggal_lahir" name="tanggal_lahir"
                                                data-date-autoclose="true" placeholder="Tanggal Lahir"
                                                data-date-format="dd/mm/yyyy" class="form-control datepicker"
                                                value="{{ $pasangan->tanggal_lahir }}">
                                        </div>
                                        <small class="text-danger" id="error_tanggal_lahir"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Tanggal Kawin</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tanggal_kawin" name="tanggal_kawin"
                                                data-date-autoclose="true" placeholder="Tanggal Kawin"
                                                value="{{ $pasangan->tanggal_kawin }}" data-date-format="dd/mm/yyyy"
                                                class="form-control datepicker">
                                        </div>
                                        <small class="text-danger" id="error_tanggal_kawin"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">No Kartu</label>
                                        <input type="text" class="form-control" id="no_kartu" name="no_kartu"
                                            placeholder="No Kartu" value="{{ $pasangan->no_kartu }}">
                                        <small class="text-danger" id="error_no_kartu"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">PNS</label>
                                        <select class="form-control custom-select" name="is_pns">
                                            <option value="">-- Pilih Status PNS--</option>
                                            <option value="1" @if ($pasangan->status_pns == 1) selected @endif>Ya
                                            </option>
                                            <option value="0" @if ($pasangan->status_pns == 0) selected @endif>Tidak
                                            </option>
                                        </select>
                                        <small class="text-danger" id="error_is_pns"></small>

                                    </div>
                                    <div class="form-group multiselect_div col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Pendidikan</label>
                                        <select id="pendidikan_id" name="pendidikan_id"
                                            class="select-filter multiselect multiselect-custom">
                                            <option value="">-- Pilih Pendidikan--</option>
                                            @foreach ($pendidikan as $item)
                                                @if ($item->id == $pasangan->pendidikan_id)
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
                                        <label class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                            placeholder="Pekerjaan" value="{{ $pasangan->pekerjaan }}">
                                        <small class="text-danger" id="error_pekerjaan"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Status Tunjangan</label>
                                        <select class="form-control custom-select" name="status_tunjangan">
                                            <option value="">-- Pilih Status Tunjangan--</option>
                                            <option value="1" @if ($pasangan->status_tunjangan == 1) selected @endif>Aktif
                                            </option>
                                            <option value="0" @if ($pasangan->status_tunjangan == 0) selected @endif>Non
                                                Aktif</option>
                                        </select>
                                        <small class="text-danger" id="error_status_tunjangan"></small>

                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">No SK Cerai</label>
                                        <input type="text" class="form-control" id="no_sk_cerai" name="no_sk_cerai"
                                            placeholder="No SK Cerai" value="{{ $pasangan->no_sk_cerai }}">
                                        <small class="text-danger" id="error_no_sk_cerai"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Tmt SK Cerai</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tmt_sk_cerai" name="tmt_sk_cerai"
                                                data-date-autoclose="true" placeholder="Tmt SK Cerai"
                                                data-date-format="dd/mm/yyyy" class="form-control datepicker"
                                                value="{{ $pasangan->tmt_sk_cerai }}">
                                        </div>
                                        <small class="text-danger" id="error_tmt_sk_cerai"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Jenis Kawin</label>
                                        <select class="form-control custom-select" name="jenis_kawin_id">
                                            <option value="">-- Pilih Jenis Kawin--</option>
                                            @foreach ($jenis_kawin as $item)
                                                @if ($item->id == $pasangan->jenis_kawin_id)
                                                    <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="error_jenis_kawin_id"></small>

                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">No Buku Nikah</label>
                                        <input type="text" class="form-control" id="no_buku_nikah"
                                            name="no_buku_nikah" placeholder="No Buku Nikah"
                                            value="{{ $pasangan->no_buku_nikah }}">
                                        <small class="text-danger" id="error_no_buku_nikah"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Buku Nikah</label>
                                        <div class="input-group">
                                            <input type="file" id="media_buku_nikah" name="media_buku_nikah">
                                            <small class="text-danger" id="error_media_buku_nikah"></small>
                                            @if (!empty($pasangan->media_buku_nikah))
                                                <a href='{{ $pasangan->media_buku_nikah }}' target="_blank">File
                                                    Sekarang :
                                                    {{ $pasangan->media_buku_nikah->file_name }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">KK Pasangan</label>
                                        <div class="input-group">
                                            <input type="file" id="media_kk_pasangan" name="media_kk_pasangan">
                                            <small class="text-danger" id="error_media_kk_pasangan"></small>
                                            @if (!empty($pasangan->media_kk_pasangan))
                                                <a href='{{ $pasangan->media_kk_pasangan }}' target="_blank">File
                                                    Sekarang :
                                                    {{ $pasangan->media_kk_pasangan->file_name }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <a href="{{ route('pegawai.show', $pasangan->pegawai_id) }}" type="button"
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
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
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
                        if (err.tanggal_kawin) {
                            $('#error_tanggal_kawin').text(err.tanggal_kawin)
                        }
                        if (err.no_kartu) {
                            $('#error_no_kartu').text(err.no_kartu)
                        }
                        if (err.is_pns) {
                            $('#error_is_pns').text(err.is_pns)
                        }
                        if (err.pendidikan_id) {
                            $('#error_pendidikan_id').text(err.pendidikan_id)
                        }
                        if (err.pekerjaan) {
                            $('#error_pekerjaan').text(err.pekerjaan)
                        }
                        if (err.status_tunjangan) {
                            $('#error_status_tunjangan').text(err.status_tunjangan)
                        }
                        if (err.no_sk_cerai) {
                            $('#error_no_sk_cerai').text(err.no_sk_cerai)
                        }
                        if (err.tmt_sk_cerai) {
                            $('#error_tmt_sk_cerai').text(err.tmt_sk_cerai)
                        }
                        if (err.jenis_kawin_id) {
                            $('#error_jenis_kawin_id').text(err.jenis_kawin_id)
                        }
                        if (err.no_buku_nikah) {
                            $('#error_no_buku_nikah').text(err.no_buku_nikah)
                        }
                        if (err.media_buku_nikah) {
                            $('#error_media_buku_nikah').text(err.media_buku_nikah)
                        }
                        if (err.media_kk_pasangan) {
                            $('#error_media_kk_pasangan').text(err.media_kk_pasangan)
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
            $('#error_tanggal_kawin').text('')
            $('#error_no_kartu').text('')
            $('#error_is_pns').text('')
            $('#error_pekerjaan').text('')
            $('#error_status_tunjangan').text('')
            $('#error_no_sk_cerai').text('')
            $('#error_tmt_sk_cerai').text('')
            $('#error_jenis_kawin_id').text('')
            $('#error_no_buku_nikah').text('')
            $('#error_media_buku_nikah').text('')
            $('#error_media_kk_pasangan').text('')
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

        const drEvent = $('#media_kk_pasangan').dropify();
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
