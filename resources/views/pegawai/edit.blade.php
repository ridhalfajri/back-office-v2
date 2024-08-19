@extends('template')
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
    {{-- DateRange --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" />
    {{-- File Upload --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}">
@endpush

@push('breadcrumb')
    <div class="btn-group btn-breadcrumb">
        <a href="/" class="btn btn-light"><i class="fa fa-home"></i></a>
        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-light"><i class="fa fa-list"></i> Data
            Pegawai</a>
        <a href="#" class="btn"><i class="fa fa-pencil-square" aria-hidden="true"></i> Ubah Data Pegawai</a>
        {{-- <a href="/" class="btn btn-outline-danger"><i class="fa fa-chevron-circle-left"></i> Kembali</a> --}}
    </div>
@endpush

@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-content">
                    <form class="needs-validation" id="pegawaiFormEdit" method="post"
                        action="{{ route('pegawai.update', $pegawai->id) }}" accept-charset="utf-8" novalidate>
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="pegawai_id" id="pegawai_id" value="{{ $pegawai->id }}">

                        <div class="row clearfix">
                            <div class="form-group col-sm-6 col-md-4">
                                <label class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik"
                                    placeholder="Nomor Induk Kependudukan" value="{{ $pegawai->nik }}">
                                <small class="text-danger" id="error_nik"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-4">
                                <label class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip"
                                    placeholder="Nomor Induk Pegawai" value="{{ $pegawai->nip }}">
                                <small class="text-danger" id="error_nip"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-4">
                                <label class="form-label">NPWP</label>
                                <input type="text" class="form-control" id="npwp" name="npwp"
                                    placeholder="Nomor Pokok Wajib Pajak" value="{{ $pegawai->npwp }}">
                                <small class="text-danger" id="error_npwp"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" class="form-control" id="nama_depan" name="nama_depan"
                                    placeholder="Nama Depan" value="{{ $pegawai->nama_depan }}">
                                <small class="text-danger" id="error_nama_depan"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang"
                                    placeholder="Nama Belakang" value="{{ $pegawai->nama_belakang }}">
                                <small class="text-danger" id="error_nama_belakang"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="L" @if ($pegawai->jenis_kelamin == 'L') selected @endif>Laki-Laki
                                    </option>
                                    <option value="P" @if ($pegawai->jenis_kelamin == 'P') selected @endif>Perempuan
                                    </option>
                                </select>
                                <small class="text-danger" id="error_jenis_kelamin"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-3">
                                <label class="form-label">Agama</label>
                                <select class="form-control" id="agama_id" name="agama_id">
                                    <option value="">-- Pilih Agama--</option>
                                    @foreach ($agama as $item)
                                        @if ($item->id == $pegawai->agama_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_agama_id"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-3">
                                <label class="form-label">Golongan Darah</label>
                                <select class="form-control" id="golongan_darah" name="golongan_darah">
                                    <option value="A+" @if ($pegawai->golongan_darah == 'A+') selected @endif>A+</option>
                                    <option value="A-" @if ($pegawai->golongan_darah == 'A-') selected @endif>A-</option>
                                    <option value="AB+" @if ($pegawai->golongan_darah == 'AB+') selected @endif>AB+</option>
                                    <option value="AB-" @if ($pegawai->golongan_darah == 'AB-') selected @endif>AB-</option>
                                    <option value="B+" @if ($pegawai->golongan_darah == 'B+') selected @endif>B+</option>
                                    <option value="B-" @if ($pegawai->golongan_darah == 'B-') selected @endif>B-</option>
                                    <option value="O+" @if ($pegawai->golongan_darah == 'O+') selected @endif>O+</option>
                                    <option value="O-" @if ($pegawai->golongan_darah == 'O-') selected @endif>O-</option>
                                </select>
                                <small class="text-danger" id="error_golongan_darah"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-3">
                                <label class="form-label">Status Nikah</label>
                                <select class="form-control" id="jenis_kawin_id" name="jenis_kawin_id">
                                    <option value="">-- Pilih Status Nikah--</option>
                                    @foreach ($jenis_kawin as $item)
                                        @if ($item->id == $pegawai->jenis_kawin_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_jenis_kawin_id"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    placeholder="Tempat Lahir" value="{{ $pegawai->tempat_lahir }}">
                                <small class="text-danger" id="error_tempat_lahir"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input data-provide="datepicker" id="tanggal_lahir" name="tanggal_lahir"
                                        data-date-autoclose="true" placeholder="Tanggal Lahir"
                                        value="{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}"
                                        data-date-format="dd/mm/yyyy" class="form-control datepicker">
                                </div>
                                <small class="text-danger" id="error_tanggal_lahir"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-4">
                                <label class="form-label">Email Kantor</label>
                                <input type="email" class="form-control" id="email_kantor" name="email_kantor"
                                    placeholder="Email Kantor" value="{{ $pegawai->email_kantor }}">
                                <small class="text-danger" id="error_email_kantor"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-4">
                                <label class="form-label">Email Pribadi</label>
                                <input type="email" class="form-control" id="email_pribadi" name="email_pribadi"
                                    placeholder="Email Pribadi" value="{{ $pegawai->email_pribadi }}">
                                <small class="text-danger" id="error_email_pribadi"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-4">
                                <label class="form-label">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp"
                                    placeholder="Nomor Telepon" value="{{ $pegawai->no_telp }}">
                                <small class="text-danger" id="error_no_telp"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">Jenis Pegawai</label>
                                <select class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id">
                                    <option value="">-- Pilih Jenis Pegawai--</option>
                                    @foreach ($jenis_pegawai as $item)
                                        @if ($item->id == $pegawai->jenis_pegawai_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_jenis_pegawai_id"></small>
                            </div>

                            <div class="form-group col-sm-3 col-md-3">
                                <label class="form-label">Status Pegawai</label>
                                <select class="form-control" id="status_pegawai_id" name="status_pegawai_id">
                                    <option value="">-- Pilih Status Pegawai--</option>
                                    @foreach ($status_pegawai as $item)
                                        @if ($item->id == $pegawai->status_pegawai_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_status_pegawai_id"></small>
                            </div>

                            <div class="form-group col-sm-3 col-md-3">
                                <label class="form-label">Status Dinas</label>
                                <select class="form-control" id="status_dinas" name="status_dinas">
                                    <option value="0" @if ($pegawai->status_dinas == '0') selected @endif>Tidak Aktif
                                    </option>
                                    <option value="1" @if ($pegawai->status_dinas == '1') selected @endif>Aktif
                                    </option>
                                </select>
                                <small class="text-danger" id="error_status_dinas"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">Tanggal Berhenti</label>
                                <div class="input-group">
                                    <input data-provide="datepicker" id="tanggal_berhenti" name="tanggal_berhenti"
                                        data-date-autoclose="true" placeholder="Tanggal Berhenti"
                                        value="{{ !empty($pegawai->tanggal_berhenti) ? \Carbon\Carbon::parse($pegawai->tanggal_berhenti)->format('d-m-Y') : '' }}"
                                        data-date-format="dd/mm/yyyy" class="form-control datepicker">
                                </div>
                                <small class="text-danger" id="error_tanggal_berhenti"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">Tanggal Wafat</label>
                                <div class="input-group">
                                    <input data-provide="datepicker" id="tanggal_wafat" name="tanggal_wafat"
                                        data-date-autoclose="true" placeholder="Tanggal Wafat"
                                        value="{{ !empty($pegawai->tanggal_wafat) ? \Carbon\Carbon::parse($pegawai->tanggal_wafat)->format('d-m-Y') : '' }}"
                                        data-date-format="dd/mm/yyyy" class="form-control datepicker">
                                </div>
                                <small class="text-danger" id="error_tanggal_wafat"></small>
                            </div>

                            <div class="form-group col-sm-4 col-md-4">
                                <label class="form-label">No BPJS</label>
                                <input type="text" class="form-control" id="no_bpjs" name="no_bpjs"
                                    placeholder="Nomor BPJS" value="{{ $pegawai->no_bpjs }}">
                                <small class="text-danger" id="error_no_bpjs"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">No Taspen</label>
                                <input type="text" class="form-control" id="no_taspen" name="no_taspen"
                                    placeholder="Nomor Taspen" value="{{ $pegawai->no_taspen }}">
                                <small class="text-danger" id="error_no_taspen"></small>
                            </div>

                            <div class="form-group col-sm-6 col-md-6">
                                <label class="form-label">No Fingerprint</label>
                                <input readonly type="text" class="form-control" id="no_enroll" name="no_enroll"
                                    placeholder="Nomor Fingerprint" value="{{ $pegawai->no_enroll }}">
                                <small class="text-danger" id="error_no_enroll"></small>
                            </div>

                            {{-- <div class="form-group col-sm-4 col-md-4">
                              <label class="form-label">No Kartu Pegawai</label>
                              <input type="text" class="form-control" id="no_kartu_pegawai" name="no_kartu_pegawai"
                                  placeholder="Nomor Kartu Pegawai" value="{{ $pegawai->no_kartu_pegawai }}">
                              <small class="text-danger" id="error_no_kartu_pegawai"></small>
                          </div> --}}

                            <div class="form-group col-md-6 col-sm-6">
                                <label class="form-label">Foto Pegawai</label>
                                <div class="input-group">
                                    <input type="file" id="media_foto_pegawai" name="media_foto_pegawai">
                                    <small class="text-danger" id="error_media_foto_pegawai"></small>
                                    @if (!empty($pegawai->media_foto_pegawai))
                                        <a href="{{ $pegawai->media_foto_pegawai }}" target="_blank">File
                                            Sekarang :
                                            Lihat File</a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-sm-6">
                                <label class="form-label">Kartu Pegawai</label>
                                <div class="input-group">
                                    <input type="file" id="media_kartu_pegawai" name="media_kartu_pegawai">
                                    <small class="text-danger" id="error_media_kartu_pegawai"></small>
                                    @if (!empty($pegawai->media_kartu_pegawai))
                                        <a href="{{ $pegawai->media_kartu_pegawai }}" target="_blank">File
                                            Sekarang :
                                            Lihat File</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i
                                class="fa fa-check-square" aria-hidden="true"></i> Simpan Perubahan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2-4.0.13/dist/js/select2.min.js') }}"></script>
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

        const media_foto_pegawai = $('#media_foto_pegawai').dropify();
        media_foto_pegawai.on('dropify.beforeClear', function(event, element) {});

        media_foto_pegawai.on('dropify.afterClear', function(event, element) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'File berhasil dihapus!',
                showConfirmButton: false,
                timer: 1500
            })
        });

        const media_kartu_pegawai = $('#media_kartu_pegawai').dropify();
        media_kartu_pegawai.on('dropify.beforeClear', function(event, element) {});

        media_kartu_pegawai.on('dropify.afterClear', function(event, element) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'File berhasil dihapus!',
                showConfirmButton: false,
                timer: 1500
            })
        });

        $('#pegawaiFormEdit').submit(function(e) {
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
                        if (err.nik) {
                            $('#error_nik').text(err.nik)
                        }
                        if (err.error_npwp) {
                            $('#error_npwp').text(err.error_npwp)
                        }
                        if (err.nip) {
                            $('#error_nip').text(err.nip)
                        }
                        if (err.nama_depan) {
                            $('#error_nama_depan').text(err.nama_depan)
                        }
                        if (err.nama_belakang) {
                            $('#error_nama_belakang').text(err.nama_belakang)
                        }
                        if (err.jenis_kelamin) {
                            $('#error_jenis_kelamin').text(err.jenis_kelamin)
                        }
                        if (err.agama_id) {
                            $('#error_agama_id').text(err.agama_id)
                        }
                        if (err.golongan_darah) {
                            $('#error_golongan_darah').text(err.golongan_darah)
                        }
                        if (err.jenis_kawin_id) {
                            $('#error_jenis_kawin_id').text(err.jenis_kawin_id)
                        }
                        if (err.tempat_lahir) {
                            $('#error_tempat_lahir').text(err.tempat_lahir)
                        }
                        if (err.tanggal_lahir) {
                            $('#error_tanggal_lahir').text(err.tanggal_lahir)
                        }
                        if (err.email_kantor) {
                            $('#error_email_kantor').text(err.email_kantor)
                        }
                        if (err.email_pribadi) {
                            $('#error_email_pribadi').text(err.email_pribadi)
                        }
                        if (err.no_telp) {
                            $('#error_no_telp').text(err.no_telp)
                        }
                        if (err.jenis_pegawai_id) {
                            $('#error_jenis_pegawai_id').text(err.jenis_pegawai_id)
                        }
                        if (err.status_pegawai_id) {
                            $('#error_status_pegawai_id').text(err.status_pegawai_id)
                        }
                        if (err.status_dinas) {
                            $('#error_status_dinas').text(err.status_dinas)
                        }
                        if (err.tanggal_berhenti) {
                            $('#error_tanggal_berhenti').text(err.tanggal_berhenti)
                        }
                        if (err.tanggal_wafat) {
                            $('#error_tanggal_wafat').text(err.tanggal_wafat)
                        }
                        if (err.no_bpjs) {
                            $('#error_no_bpjs').text(err.no_bpjs)
                        }
                        if (err.no_taspen) {
                            $('#error_no_taspen').text(err.no_taspen)
                        }
                        if (err.no_enroll) {
                            $('#error_no_enroll').text(err.no_enroll)
                        }
                        if (err.no_kartu_pegawai) {
                            $('#error_no_kartu_pegawai').text(err.no_kartu_pegawai)
                        }
                        if (err.media_kartu_pegawai) {
                            $('#error_media_kartu_pegawai').text(err.media_kartu_pegawai)
                        }
                        if (err.media_foto_pegawai) {
                            $('#error_media_foto_pegawai').text(err.media_foto_pegawai)
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
            $('#error_npwp').text('')
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
            $('#error_media_foto_pasangan').text('')
        }
    </script>
@endpush
