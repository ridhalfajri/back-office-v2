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
@push('breadcrumb')
    <ol class="breadcrumb custom-background-color">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{route('cuti.riwayat-cuti')}}">Riwayat Cuti</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
@endpush
@section('content')
    <div class="col-md-8 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">FORM PENGAJUAN CUTI</h3>
            </div>
            <form id="form-pengajuan" action="{{ route('cuti.store-cuti') }}" enctype="multipart/form-data" method="POST"
                autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="form-group multiselect_div">
                        <label class="form-label">Jenis Cuti</label>
                        <select id="jenis_cuti_id" name="jenis_cuti_id"
                            class="select-filter multiselect multiselect-custom">
                            @foreach ($jenis_cuti as $item)
                                <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger" id="error_jenis_cuti_id"></small>

                    </div>
                    <div class="row" id="alasan">
                        <div class="form-group col-md-6">
                            <label class="form-label">Alasan</label>
                            <select class="form-control custom-select" name="keterangan_cuti_p" id="keterangan_cuti_p">
                                <option value="">--Alasan--</option>
                                <option value="Keluarga Sakit Keras">Keluarga Sakit Keras</option>
                                <option value="Keluarga Meninggal Dunia">Keluarga Meninggal Dunia</option>
                                <option value="Melangsungkan Pernikahan">Melangsungkan Pernikahan</option>
                                <option value="Isteri Melahirkan">Isteri Melahirkan</option>
                                <option value="Kebakaran Rumah/ Bencana Alam">Kebakaran Rumah/ Bencana Alam</option>
                                <option value="Ditempatkan di Kantor perwakilan RI yang rawan/berbahaya">Ditempatkan di
                                    Kantor perwakilan RI yang rawan/berbahaya</option>
                            </select>
                            <small class="text-danger" id="error_keterangan_cuti_p"></small>

                        </div>
                        <div class="form-group col-md-6" id="detail_alasan">
                            <label class="form-label">Yang Bersangkutan</label>
                            <select class="form-control custom-select" name="detail_keterangan_cuti_p"
                                id="detail_keterangan_cuti_p">
                                <option value="">--Keluarga Bersangkutan--</option>
                                <option value="Ayah">Ayah</option>
                                <option value="Ibu">Ibu</option>
                                <option value="Suami/Istri">Suami/Istri</option>
                                <option value="Anak">Anak</option>
                                <option value="Adik">Adik</option>
                                <option value="Kakak">Kakak</option>
                                <option value="Mertua">Mertua</option>
                                <option value="Menantu">Menantu</option>
                            </select>
                            <small class="text-danger" id="error_detail_keterangan_cuti_p"></small>
                        </div>
                    </div>
                    <div class="row" id="saldo_cuti">
                        <div class="form-group col-md-3">
                            <label class="form-label">Sisa Cuti {{ Carbon\Carbon::now()->format('Y') }}</label>
                            <input type="text" class="form-control" placeholder="Disabled.."
                                value="{{ $saldo_cuti->saldo_n }}" readonly="">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">Sisa Cuti {{ Carbon\Carbon::now()->format('Y') - 1 }}</label>
                            <input type="text" class="form-control" placeholder="Disabled.."
                                value="{{ $saldo_cuti->saldo_n_1 }}" readonly="">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">Sisa Cuti {{ Carbon\Carbon::now()->format('Y') - 2 }}</label>
                            <input type="text" class="form-control" placeholder="Disabled.."
                                value="{{ $saldo_cuti->saldo_n_2 }}" readonly="">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label">Saldo Cuti Sekarang</label>
                            <input type="text" class="form-control" placeholder="Disabled.."
                                value="{{ $saldo_cuti->total }}" readonly="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <label>Tanggal Cuti</label>
                            <input class="form-control input-daterange-datepicker" type="text" name="tanggal_cuti"
                                id="tanggal_cuti" value="">
                            <small class="text-danger" id="error_tanggal_cuti"></small>


                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label>Lama Cuti</label>
                            <input type="text" id="lama_cuti" name="lama_cuti" class="form-control" value=""
                                readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">No. Telepon yang Bisa Dihubungi Selama Cuti</label>
                        <input type="number" id="no_telepon_cuti" name="no_telepon_cuti" class="form-control"
                            placeholder="No Telp" value="">
                        <small class="text-danger" id="error_no_telepon_cuti"></small>

                    </div>
                    <div class="form-group">
                        <label class="form-label">Alasan Lengkap Cuti</label>
                        <textarea class="form-control" id="alasan" name="alasan" placeholder="Alasan Cuti"></textarea>
                        <small class="text-danger" id="error_alasan"></small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat / Lokasi Selama Menjalankan Cuti</label>
                        <textarea class="form-control" id="alamat_cuti" name="alamat_cuti" placeholder="Alamat Cuti"></textarea>
                        <small class="text-danger" id="error_alamat_cuti"></small>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label class="form-label">Lampiran <small class="text-danger">(jika diperlukan, misal : Surat
                                Keterangan Sakit, dll)</small></label>
                        <div class="input-group">
                            <input type="file" id="media_pengajuan_cuti" name="media_pengajuan_cuti">
                            <small class="text-danger" id="error_media_pengajuan_cuti"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-controls-stacked">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                    value="" required>
                                <small class="custom-control-label">Apakah anda yakin data yang diisikan benar dan
                                    valid?</small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">

                    <button type="submit" class="btn btn-primary px-5">Kirim</button>
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
        $(() => {
            $('#alasan').hide()
        })
        //HIDE SALDO CUTI
        $('#jenis_cuti_id').on('change', () => {
            const jenis_cuti = $('#jenis_cuti_id').find(":selected").val();
            const date_now = moment().format('DD-MM-YYYY')
            $('#tanggal_cuti').val(`${date_now} - ${date_now}`)
            $('#lama_cuti').val(1)
            if (jenis_cuti != 1) {
                $('#saldo_cuti').hide()
            } else {
                $('#saldo_cuti').show()
            }
            if (jenis_cuti != 5) {
                $('#alasan').hide()
            } else {
                $('#alasan').show()
                $("#media_pengajuan_cuti").prop('required', true);

            }
        })

        $('#keterangan_cuti_p').on('change', () => {
            const detail_alasan = $('#keterangan_cuti_p').find(":selected").val()
            console.log(detail_alasan)
            if (detail_alasan == 'Keluarga Sakit Keras' || detail_alasan == 'Keluarga Meninggal Dunia') {
                $('#detail_alasan').show()
            } else {
                $('#detail_alasan').hide()

            }
        })
        //CHECK HARI LIBUR
        $('#tanggal_cuti').on('change', () => {
            const tanggal_cuti = $('#tanggal_cuti').val()
            const split_tanggal = tanggal_cuti.split(' - ')
            $.ajax({
                type: "POST",
                url: '{{ route('cuti.cek_hari_libur') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    tanggal_mulai: split_tanggal[0],
                    tanggal_akhir: split_tanggal[1],
                    saldo_cuti: '{{ $saldo_cuti->total }}',
                    jenis_cuti: $('#jenis_cuti_id').val()
                },
                success: function(response) {
                    if (response.errors) {
                        if (response.errors.saldo) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.errors.saldo,
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            })
                            const date_now = moment().format('DD-MM-YYYY')
                            $('#tanggal_cuti').val(`${date_now} - ${date_now}`)
                            $('#lama_cuti').val(1)

                        } else if(response.errors.tahun){
                            if (response.errors.tahun) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.errors.tahun,
                                    icon: 'error',
                                    confirmButtonText: 'Tutup'
                                })
                                const date_now = moment().format('DD-MM-YYYY')
                                $('#tanggal_cuti').val(`${date_now} - ${date_now}`)
                                $('#lama_cuti').val(1)

                            }
                        }
                    } else if (response.success) {
                        $('#lama_cuti').val(response.success.lama_cuti)
                    }
                }
            });
        })

        //SUBMIT FORM

        $('#form-pengajuan').submit(function(e) {
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
                    resetForm()
                    if (response.errors) {
                        const err = response.errors
                        if (err.jenis_cuti_id) {
                            $('#error_jenis_cuti_id').text(err.jenis_cuti_id)
                        }
                        if (err.tanggal_cuti) {
                            $('#error_tanggal_cuti').text(err.tanggal_cuti)
                        }
                        if (err.no_telepon_cuti) {
                            $('#error_no_telepon_cuti').text(err.no_telepon_cuti)
                        }
                        if (err.alasan) {
                            $('#error_alasan').text(err.alasan)
                        }
                        if (err.alamat_cuti) {
                            $('#error_alamat_cuti').text(err.alamat_cuti)
                        }
                        if (err.media_pengajuan_cuti) {
                            $('#error_media_pengajuan_cuti').text(err.media_pengajuan_cuti)
                        }
                        if (err.keterangan_cuti_p) {
                            $('#error_keterangan_cuti_p').text(err.keterangan_cuti_p)
                        }
                        if (err.detail_keterangan_cuti_p) {
                            $('#error_detail_keterangan_cuti_p').text(err.detail_keterangan_cuti_p)
                        }
                    } else {
                        Swal.fire({
                            title: 'Tersimpan!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'Tutup'
                        })
                        resetForm();
                        window.location.href = '{{ route('cuti.riwayat-cuti') }}'
                    }
                }
            });
        });

        function resetForm(is_success = false) {
            $('#error_jenis_cuti_id').text('')
            $('#error_tanggal_cuti').text('')
            $('#error_no_telepon_cuti').text('')
            $('#error_alasan').text('')
            $('#error_alamat_cuti').text('')
            $('#error_media_pengajuan_cuti').text('')
            $('#error_keterangan_cuti_p').text('')
            $('#error_detail_keterangan_cuti_p').text('')
        }
    </script>
    <script>
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',
            locale: {
                format: 'DD-MM-YYYY'
            },
            autoApply: true
        });
        $('.select-filter').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200
        });

        $('.dropify').dropify();

        const drEvent = $('#media_pengajuan_cuti').dropify();
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
