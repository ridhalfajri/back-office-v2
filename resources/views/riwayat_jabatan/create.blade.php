@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
    {{-- File Upload --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}">
@endpush
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold ">Tambah Riwayat Jabatan</h3>
            </div>
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="riwayatJabatanFormCreate" method="post"  action="{{ route('riwayat-jabatan-all.store') }}"  accept-charset="utf-8" novalidate>
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="form-group col-md-4 col-lg-4">
                                <label class="form-label">Nama Pegawai</label>
                                <select class="form-control" id="pegawai_id" name="pegawai_id">
                                    <option value="">-- Pilih Pegawai --</option>
                                </select>
                                <small class="text-danger" id="error_pegawai_id"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">Nomor SK</label>
                                <input type="text" class="form-control" id="no_sk" name="no_sk"
                                    placeholder="Nomor Surat Keputusan">
                                <small class="text-danger" id="error_no_sk"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">Tanggal SK</label>
                                <div class="input-group">
                                    <input data-provide="datepicker" id="tanggal_sk" name="tanggal_sk"
                                        data-date-autoclose="true" placeholder="Tanggal Surat Keputusan"
                                        class="form-control datepicker" readonly>
                                </div>
                                <small class="text-danger" id="error_tanggal_sk"></small>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                              <label class="form-label">Upload SK Jabatan</label>
                              <div class="input-group">
                                  <input type="file" id="media_sk_jabatan" name="media_sk_jabatan">
                                  <small class="text-danger" id="error_media_sk_jabatan"></small>
                              </div>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Nomor Pelantikan</label>
                                <input type="text" class="form-control" id="no_pelantikan" name="no_pelantikan"
                                    placeholder="Nomor Pelantikan">
                                <small class="text-danger" id="error_no_pelantikan"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Tanggal Pelantikan</label>
                                <div class="input-group">
                                    <input data-provide="datepicker" id="tanggal_pelantikan" name="tanggal_pelantikan"
                                        data-date-autoclose="true" placeholder="Tanggal Pelantikan"
                                        class="form-control datepicker" readonly>
                                </div>
                                <small class="text-danger" id="error_tanggal_pelantikan"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">TMT Jabatan</label>
                                <div class="input-group">
                                    <input data-provide="datepicker" id="tmt_jabatan" name="tmt_jabatan"
                                        data-date-autoclose="true" placeholder="TMT Jabatan"
                                        class="form-control datepicker" readonly>
                                </div>
                                <small class="text-danger" id="error_tmt_jabatan"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Pejabat Penetap</label>
                                <input type="text" class="form-control" id="pejabat_penetap" name="pejabat_penetap"
                                    placeholder="Pejabat Penetap">
                                <small class="text-danger" id="error_pejabat_penetap"></small>
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <label class="form-label">Apakah sedang merangkap sebagai Plt.?</label>
                                <select class="form-control" id="is_plt" name="is_plt">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <label class="form-label">Unit Kerja</label>
                                <select class="form-control" id="hirarki_unit_kerja_id" name="hirarki_unit_kerja_id">
                                    <option value="">-- Pilih Unit Kerja --</option>
                                    @foreach ($unit_kerja as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_hirarki_unit_kerja_id"></small>
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <label class="form-label">Tipe Pegawai</label>
                                <select class="form-control" id="tx_tipe_jabatan_id" name="tx_tipe_jabatan_id">
                                    <option value="">-- Pilih Tipe Pegawai --</option>
                                    @foreach ($tx_tipe_jabatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipe_jabatan }}
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_tx_tipe_jabatan_id"></small>
                            </div>

                            <div class="form-group col-md-12 col-lg-12">
                                <label class="form-label">Grade Tukin</label>
                                <select class="form-control" id="tukin_id" name="tukin_id">
                                    <option value="">-- Pilih Grade Tukin --</option>
                                    @foreach ($grade_tukin as $item)
                                        <option value="{{ $item->id }}">{{ $item->grade }}
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_tukin_id"></small>
                            </div>
                            
                        </div>

                        <button type="submit" id="tombol-simpan" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-check-square" aria-hidden="true"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- SweetAlert --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2-4.0.13/dist/js/select2.min.js') }}"></script>
    {{-- DateRange --}}
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- File Upload --}}
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
    </script>
    <script>
        const media_sk_jabatan = $('#media_sk_jabatan').dropify();
        media_sk_jabatan.on('dropify.beforeClear', function(event, element) {});

        media_sk_jabatan.on('dropify.afterClear', function(event, element) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'File berhasil dihapus!',
                showConfirmButton: false,
                timer: 1500
            })
        });
    </script>
    <script>
        $('#hirarki_unit_kerja_id').select2();

        //Select2 Pegawai
        $('#pegawai_id').select2({
            ajax: {
                url: "{{ route('riwayat-jabatan-all.get_nama_pegawai') }}",
                delay: 500,
                dataType: 'json',
                minimumInputLength: 3,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function(obj) {
                            if(obj.id!=0){
                            // console.log(obj);
                            return { id: obj.id, text: obj.name };
                        }
                            else
                                {return {id: obj.id, text: obj.name}}
                        })
                    };

                }
            }
        });

        $('#tx_tipe_jabatan_id').change(function() {
            if($('#tx_tipe_jabatan_id').val() == 6) {
                $('.remove').remove();
                $('.remove-child').remove();

                $('.row')
                .append('<div class="form-group col-md-12 col-lg-12 remove">\
                            <label class="form-label">Tipe Fungsional</label>\
                            <select class="form-control" id="tipe_fungsional" name="jenis_jabatan_id">\
                                <option value="">-- Pilih Tipe Fungsional --</option>\
                                <option value="4">Fungsional Umum</option>\
                                <option value="2">Fungsional Tertentu</option>\
                            </select>\
                            <small class="text-danger" id="error_jenis_jabatan_id"></small>\
                        </div>');
                
                $('#tipe_fungsional').change(function() {
                    if($('#tipe_fungsional').val() == 4) {
                        $('.remove-child').remove();

                        $('.row')
                        .append('<div class="form-group col-md-12 col-lg-12 remove-child">\
                                    <label class="form-label">Fungsional Umum</label>\
                                    <select class="form-control" id="fungsional_umum" name="jabatan_id">\
                                        <option value="">-- Pilih Fungsional Umum --</option>\
                                    </select>\
                                    <small class="text-danger" id="error_jabatan_id"></small>\
                                </div>');

                        $('#fungsional_umum').select2({
                            ajax: {
                                url: "{{ route('riwayat-jabatan-all.get_fungsional_umum') }}",
                                delay: 500,
                                dataType: 'json',
                                minimumInputLength: 3,
                                data: function (params) {
                                    return {
                                        q: params.term, // search term
                                        page: params.page
                                    };
                                },
                                processResults: function (data) {
                                    return {
                                        results: $.map(data, function(obj) {
                                            if(obj.id!=0){
                                            // console.log(obj);
                                            return { id: obj.id, text: obj.name };
                                        }
                                            else
                                                {return {id: obj.id, text: obj.name}}
                                        })
                                    };

                                }
                            }
                        });
                    } else if($('#tipe_fungsional').val() == 2) {
                        $('.remove-child').remove();

                        $('.row')
                        .append('<div class="form-group col-md-12 col-lg-12 remove-child">\
                                    <label class="form-label">Fungsional Tertentu</label>\
                                    <select class="form-control" id="fungsional_tertentu" name="jabatan_id">\
                                        <option value="">-- Pilih Fungsional tertentu --</option>\
                                    </select>\
                                    <small class="text-danger" id="error_jabatan_id"></small>\
                                </div>');

                        $('#fungsional_tertentu').select2({
                            ajax: {
                                url: "{{ route('riwayat-jabatan-all.get_fungsional_tertentu') }}",
                                delay: 500,
                                dataType: 'json',
                                minimumInputLength: 3,
                                data: function (params) {
                                    return {
                                        q: params.term, // search term
                                        page: params.page
                                    };
                                },
                                processResults: function (data) {
                                    return {
                                        results: $.map(data, function(obj) {
                                            if(obj.id!=0){
                                            // console.log(obj);
                                            return { id: obj.id, text: obj.name };
                                        }
                                            else
                                                {return {id: obj.id, text: obj.name}}
                                        })
                                    };

                                }
                            }
                        });
                    } else {
                        $('.remove').remove();
                        $('.remove-child').remove();
                    }
                });
            } else if($('#tx_tipe_jabatan_id').val() == 2) {
                $('.remove').remove();
                $('.remove-child').remove();

                $('.row')
                .append('<div class="form-group col-md-12 col-lg-12 remove">\
                            <label class="form-label">Eselon Dua</label>\
                            <select class="form-control" id="eselon_dua" name="jabatan_id">\
                                <option value="">-- Pilih Eselon 2 --</option>\
                            </select>\
                            <input type="hidden" value="1" name="jenis_jabatan_id" />\
                            <small class="text-danger" id="error_jabatan_id"></small>\
                        </div>');

                $('#eselon_dua').select2({
                    ajax: {
                        url: "{{ route('riwayat-jabatan-all.get_eselon_dua') }}",
                        delay: 500,
                        dataType: 'json',
                        minimumInputLength: 3,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function(obj) {
                                    if(obj.id!=0){
                                    // console.log(obj);
                                    return { id: obj.id, text: obj.name };
                                }
                                    else
                                        {return {id: obj.id, text: obj.name}}
                                })
                            };

                        }
                    }
                });
            } else if($('#tx_tipe_jabatan_id').val() == 1) {
                $('.remove').remove();
                $('.remove-child').remove();

                $('.row')
                .append('<div class="form-group col-md-12 col-lg-12 remove">\
                            <label class="form-label">Eselon Satu</label>\
                            <select class="form-control" id="eselon_satu" name="jabatan_id">\
                                <option value="">-- Pilih Eselon 1 --</option>\
                            </select>\
                            <input type="hidden" value="1" name="jenis_jabatan_id" />\
                            <small class="text-danger" id="error_jabatan_id"></small>\
                        </div>');

                $('#eselon_satu').select2({
                    ajax: {
                        url: "{{ route('riwayat-jabatan-all.get_eselon_satu') }}",
                        delay: 500,
                        dataType: 'json',
                        minimumInputLength: 3,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function(obj) {
                                    if(obj.id!=0){
                                    // console.log(obj);
                                    return { id: obj.id, text: obj.name };
                                }
                                    else
                                        {return {id: obj.id, text: obj.name}}
                                })
                            };

                        }
                    }
                });
            }else {
                $('.remove').remove();
            }
        });

        $('#riwayatJabatanFormCreate').submit(function(e) {
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
                    if (response.errors) {
                        resetForm()
                        const err = response.errors
                        if (err.pegawai_id) {
                            $('#error_pegawai_id').text(err.pegawai_id)
                        }
                        if (err.no_sk) {
                            $('#error_no_sk').text(err.no_sk)
                        }
                        if (err.tanggal_sk) {
                            $('#error_tanggal_sk').text(err.tanggal_sk)
                        }
                        if (err.no_pelantikan) {
                            $('#error_no_pelantikan').text(err.no_pelantikan)
                        }
                        if (err.tanggal_pelantikan) {
                            $('#error_tanggal_pelantikan').text(err.tanggal_pelantikan)
                        }
                        if (err.tmt_jabatan) {
                            $('#error_tmt_jabatan').text(err.tmt_jabatan)
                        }
                        if (err.pejabat_penetap) {
                            $('#error_pejabat_penetap').text(err.pejabat_penetap)
                        }
                        if (err.hirarki_unit_kerja_id) {
                            $('#error_hirarki_unit_kerja_id').text(err.hirarki_unit_kerja_id)
                        }
                        if (err.tx_tipe_jabatan_id) {
                            $('#error_tx_tipe_jabatan_id').text(err.tx_tipe_jabatan_id)
                        }
                        if (err.tukin_id) {
                            $('#error_tukin_id').text(err.tukin_id)
                        }
                        if (err.jenis_jabatan_id) {
                            $('#error_jenis_jabatan_id').text(err.jenis_jabatan_id)
                        }
                        if (err.jabatan_id) {
                            $('#error_jabatan_id').text(err.jabatan_id)
                        }
                        if (err.media_sk_jabatan) {
                            $('#error_media_sk_jabatan').text(err.media_sk_jabatan)
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
                            window.location.href = '/pegawai/riwayat-jabatan/'
                        }, 1000);

                    }
                }
            });
        });

        function resetForm(is_success = false) {
            $('#error_pegawai_id').text('')
            $('#error_no_sk').text('')
            $('#error_tanggal_sk').text('')
            $('#error_no_pelantikan').text('')
            $('#error_tanggal_pelantikan').text('')
            $('#error_tmt_jabatan').text('')
            $('#error_pejabat_penetap').text('')
            $('#error_hirarki_unit_kerja_id').text('')
            $('#error_tx_tipe_jabatan_id').text('')
            $('#error_tukin_id').text('')
            $('#error_jenis_jabatan_id').text('')
            $('#error_jabatan_id').text('')
            $('#error_media_sk_jabatan').text('')
        }
    </script>

    {{-- Fungsi Cek Jabatan Eselon I atau Eselon II yang dipilih sudah ada yang menjabat atau belum --}}
    <script>
        $(document.body).on("change","#eselon_satu",function(){
            var data = {'jabatan' : $('#eselon_satu').val()}

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('riwayat-jabatan-all.cek_jabatan_yang_dipilih') }}",
                data: data,
                success: function(response) {
                    if(response.cek_jabatan != null) {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Jabatan yang dipilih sudah terisi!',
                            icon: 'warning',
                            confirmButtonText: 'Tutup'
                        })

                        $('#tombol-simpan').remove()
                        $('#riwayatJabatanFormCreate').append(
                            '<label id="label-simpan" class="btn btn-primary btn-sm waves-effect waves-light disabled">Simpan</label>'
                        )
                    } else if(response.cek_jabatan === null) {
                        $('#label-simpan').remove()
                        $('#tombol-simpan').remove()
                        $('#riwayatJabatanFormCreate').append(
                            '<button type="submit" id="tombol-simpan" class="btn btn-primary btn-sm waves-effect waves-light"><i class="fa fa-check-square" aria-hidden="true"></i> Simpan</button>'
                        )
                    }
                }
            });
        });
    </script>
@endpush