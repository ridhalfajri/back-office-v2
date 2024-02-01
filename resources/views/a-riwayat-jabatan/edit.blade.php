@extends('template')
@push('style')
    {{-- Multiselect --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" />
    {{-- File Upload --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}">
@endpush
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Perubahan Jabatan</h3>
            </div>
            <form id="form-riwayat-jabatan" action="{{ route('a-riwayat-jabatan.update') }}" enctype="multipart/form-data"
                method="POST" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label">Nama Pegawai</label>
                            <input type="text" class="form-control" placeholder="Disabled.."
                                value="{{ $prj->nama_depan }} {{ $prj->nama_belakang }}" readonly="">
                            <input type="hidden" value="{{ $prj->prj_id }}" name="pegawai_riwayat_jabatan_id"
                                id="pegawai_riwayat_jabatan_id`">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">NIP Pegawai</label>
                            <input type="text" class="form-control" placeholder="Disabled.." value="{{ $prj->nip }}"
                                readonly="">
                        </div>
                        <div class="form-group col-md-12">
                            <hr>
                        </div>

                        <div class="form-group multiselect_div col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Unit Kerja</label>
                            <select id="unit_kerja" name="unit_kerja" class="select-filter multiselect multiselect-custom"
                                disabled>
                                <option value="" selected>
                                    {{ $prj->nama_unit_kerja }}
                                </option>
                            </select>
                            <small class="text-danger" id="err_unit_kerja"></small>

                        </div>
                        <div class="form-group multiselect_div col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Jenis Jabatan</label>
                            <select id="jenis_jabatan" name="jenis_jabatan"
                                class="select-filter multiselect multiselect-custom" disabled>
                                <option value="" selected>
                                    {{ $prj->jenis_jabatan }}
                                </option>
                            </select>
                            <small class="text-danger" id="err_jenis_jabatan"></small>

                        </div>
                        <div class="form-group multiselect_div col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Jabatan</label>
                            <select id="jabatan_unit_kerja_id" name="jabatan_unit_kerja_id"
                                class="select-filter multiselect multiselect-custom" disabled>
                                <option value="" selected>
                                    {{ $prj->nama_jabatan }}
                                </option>
                            </select>
                            <small class="text-danger" id="err_jabatan_unit_kerja_id"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">No SK</label>
                            <input type="text" class="form-control" placeholder="No SK" value="{{ $prj->no_sk }}"
                                name="no_sk" id="no_sk">
                            <small class="text-danger" id="err_no_sk"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">No Pelantikan</label>
                            <input type="text" class="form-control" placeholder="No Pelantikan"
                                value="{{ $prj->no_pelantikan }}" name="no_pelantikan" id="no_pelantikan">
                            <small class="text-danger" id="err_no_pelantikan"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Tanggal SK</label>
                            <input type="date" class="form-control" placeholder="Tanggal SK"
                                value="{{ $prj->tanggal_sk }}" name="tanggal_sk" id="tanggal_sk">
                            <small class="text-danger" id="err_tanggal_sk"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Tanggal Pelantikan</label>
                            <input type="date" class="form-control" placeholder="Tanggal Pelantikan"
                                value="{{ $prj->tanggal_pelantikan }}" name="tanggal_pelantikan" id="tanggal_pelantikan">
                            <small class="text-danger" id="err_tanggal_pelantikan"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Tmt Jabatan</label>
                            <input type="date" class="form-control" placeholder="Tmt Jabatan"
                                value="{{ $prj->tmt_jabatan }}" name="tmt_jabatan" id="tmt_jabatan">
                            <small class="text-danger" id="err_tmt_jabatan"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Pejabat Penetap</label>
                            <input type="text" class="form-control" placeholder="Pejabat Penetap"
                                value="{{ $prj->pejabat_penetap }}" name="pejabat_penetap" id="pejabat_penetap">
                            <small class="text-danger" id="err_pejabat_penetap"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Status PLT </label>
                            <select class="form-control" id="is_plt" name="is_plt" required disabled>
                                <option value="">--Pilih Status PLT--</option>
                                <option value="1" @if (true) selected @endif="">Ya
                                </option>
                                <option value="0" @if (!$prj->is_now) selected @endif>
                                    Tidak</option>
                            </select>
                            <small class="text-danger" id="err_is_plt"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Status Jabatan </label>
                            <select class="form-control" id="is_now" name="is_now" required>
                                <option value="">--Pilih Status Jabatan--</option>
                                <option value="1" @if ($prj->is_now) selected @endif>Aktif</option>
                                <option value="0" @if (!$prj->is_now) selected @endif>
                                    Tidak Aktif</option>
                            </select>
                            <small class="text-danger" id="err_is_now"></small>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label">Tipe Jabatan </label>
                            <select class="form-control" id="tx_tipe_jabatan_id" required disabled>
                                <option value="" selected>
                                    {{ $prj->tipe_jabatan }}
                                </option>
                            </select>
                            <small class="text-danger" id="err_tx_tipe_jabatan_id"></small>

                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label class="form-label">File SK</label>
                            <div class="input-group">
                                <input type="file" id="media_sk_jabatan" name="media_sk_jabatan">
                                <small class="text-danger" id="err_media_sk_jabatan"></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-controls-stacked">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                    value="" required>
                                <h6 class="custom-control-label font-weight-bold"><u>Apakah anda yakin data yang diisikan
                                        benar dan
                                        valid?</u></h6>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button id="store-riwayat-jabatan" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    {{-- Multiselect --}}
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    {{-- File Upload --}}
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>

    {{-- SweetAlert --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $('#unit_kerja').on('change', function(e) {
            select_jabatan_unit_kerja()
        });
        $('#jenis_jabatan').on('change', function(e) {
            select_jabatan_unit_kerja()
        });
        const select_jabatan_unit_kerja = () => {
            $.ajax({
                type: "POST",
                url: "{{ route('a-riwayat-jabatan.get-jabatan-unit-kerja') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    unit_kerja: $('#unit_kerja').val(),
                    jenis_jabatan: $('#jenis_jabatan').val()
                },
                cache: false,
                success: function(response) {
                    $('#jabatan_unit_kerja_id').multiselect('destroy');
                    $('#jabatan_unit_kerja_id').html(response);
                    $('#jabatan_unit_kerja_id').multiselect({
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
        $('#form-riwayat-jabatan').submit(function(e) {
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
                        const err = response.errors
                        if (err.pendidikan_id) {
                            $('#error_pendidikan_id').text(err.pendidikan_id)
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
    </script>
    <script>
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });

        $('.dropify').dropify();

        const drEvent = $('#media_sk_jabatan').dropify();
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
    </script>
@endpush
