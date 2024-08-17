@extends('template')
@push('style')
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    {{-- File Upload --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}">
@endpush
@push('breadcrumb')
    <ol class="breadcrumb custom-background-color">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Pegawai</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pegawai.show', $pegawai->id) }}">Pegawai Detail</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
@endpush
@section('content')
    <div class="section-body">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Riwayat Pendidikan</h3>
                        </div>
                        <form id="form-create" action="{{ route('pendidikan.store') }}" enctype="multipart/form-data"
                            method="POST" autocomplete="off">
                            @csrf
                            <div class="card-body">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Pegawai</label>
                                        <input type="text" class="form-control" value="{{ $pegawai->nama }}"
                                            placeholder="Nama Pegawai" disabled>
                                        <input type="hidden" name="pegawai_id" id="pegawai_id" value="{{ $pegawai->id }}">
                                    </div>
                                    <div class="form-group multiselect_div col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Pendidikan</label>
                                        <select id="pendidikan_id" name="pendidikan_id"
                                            class="select-filter multiselect multiselect-custom">
                                            <option value="">-- Pilih Pendidikan--</option>
                                            @foreach ($pendidikan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger" id="error_pendidikan_id"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Nama Instansi</label>
                                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi"
                                            placeholder="Nama Instansi">
                                        <small class="text-danger" id="error_nama_instansi"></small>

                                    </div>
                                    <div class="form-group multiselect_div col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Propinsi</label>
                                        <select id="propinsi_id" name="propinsi_id" class="multiselect multiselect-custom">

                                        </select>
                                        <small class="text-danger" id="error_propinsi_id"></small>
                                    </div>
                                    <div class="form-group multiselect_div col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Kota</label>
                                        <select id="kota_id" name="kota_id"
                                            class="select-filter multiselect multiselect-custom">
                                            <option selected value="">-- Pilih Kota --</option>
                                        </select>
                                        <small class="text-danger" id="error_kota_id"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Alamat">
                                        <small class="text-danger" id="error_alamat"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Kode Gelar Depan</label>
                                        <input type="text" class="form-control" id="kode_gelar_depan"
                                            name="kode_gelar_depan" placeholder="Kode Gelar Depan">
                                        <small class="text-danger" id="error_kode_gelar_depan"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Kode Gelar Belakang</label>
                                        <input type="text" class="form-control" id="kode_gelar_belakang"
                                            name="kode_gelar_belakang" placeholder="Kode Gelar Belakang">
                                        <small class="text-danger" id="error_kode_gelar_belakang"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">No Ijazah</label>
                                        <input type="text" class="form-control" id="no_ijazah" name="no_ijazah"
                                            placeholder="No Ijazah">
                                        <small class="text-danger" id="error_no_ijazah"></small>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label class="form-label">Tanggal Ijazah</label>
                                        <div class="input-group">
                                            <input data-provide="datepicker" id="tanggal_ijazah" name="tanggal_ijazah"
                                                data-date-autoclose="true" data-date-format="dd/mm/yyyy"
                                                class="form-control datepicker">
                                        </div>
                                        <small class="text-danger" id="error_tanggal_ijazah"></small>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label">File Ijazah</label>
                                        <div class="input-group">
                                            <input type="file" id="media_ijazah" name="media_ijazah">
                                            <small class="text-danger" id="error_media_ijazah"></small>
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
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });
        $(() => {
            select_propinsi()
        })
        const select_propinsi = (propinsi_id = null) => {
            $.ajax({
                url: "{{ route('propinsi.data') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    propinsi_id: propinsi_id
                },
                success: function(response) {
                    $('#propinsi_id').html(response);
                    $('#propinsi_id').multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 200
                    });
                }
            })
        }
        const select_kota = (id = null, kota_id = null) => {
            $.ajax({
                type: "POST",
                url: "{{ route('kota.data') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr("content")
                },
                data: {
                    id: id,
                    kota_id: kota_id
                },
                cache: false,
                success: function(response) {
                    $('#kota_id').multiselect('destroy');
                    $('#kota_id').html(response);
                    $('#kota_id').multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 200
                    });
                },
                error: function(data) {
                    console.log('error : ', data);
                }
            });
        }
        $('#propinsi_id').on('change', function(e) {
            e.preventDefault();
            const id = $(this).val();
            select_kota(id)
        });


        $('#form-create').submit(function(e) {
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
                        if (err.nama_instansi) {
                            $('#error_nama_instansi').text(err.nama_instansi)
                        }
                        if (err.propinsi_id) {
                            $('#error_propinsi_id').text(err.propinsi_id)
                        }
                        if (err.kota_id) {
                            $('#error_kota_id').text(err.kota_id)
                        }
                        if (err.alamat) {
                            $('#error_alamat').text(err.alamat)
                        }
                        if (err.no_ijazah) {
                            $('#error_no_ijazah').text(err.no_ijazah)
                        }
                        if (err.kode_gelar_depan) {
                            $('#error_kode_gelar_depan').text(err.kode_gelar_depan)
                        }
                        if (err.kode_gelar_belakang) {
                            $('#error_kode_gelar_belakang').text(err.kode_gelar_belakang)
                        }
                        if (err.tanggal_ijazah) {
                            $('#error_tanggal_ijazah').text(err.tanggal_ijazah)
                        }
                        if (err.media_ijazah) {
                            $('#error_media_ijazah').text(err.media_ijazah)
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
            $('#error_nama_instansi').text('')
            $('#error_propinsi_id').text('')
            $('#error_kota_id').text('')
            $('#error_alamat').text('')
            $('#error_no_ijazah').text('')
            $('#error_tanggal_ijazah').text('')
            $('#error_media_ijazah').text('')
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

        const drEvent = $('#media_ijazah').dropify();
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
