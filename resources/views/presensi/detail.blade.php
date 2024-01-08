<div class="card-body">
    <div class="student-info">

        @php
            $jabatan = '';
            $unitkerja = '';
        @endphp

        @foreach ($pegawai as $data)
            @if($data->is_plt == 1)
                @if($jabatan == '')
                    @php
                        $jabatan = $data->nama_jabatan;
                    @endphp
                @else
                    @php
                        $jabatan = $jabatan . ' / '. $data->nama_jabatan;
                    @endphp
                @endif
            @else
                @if($jabatan == '')
                    @php
                        $jabatan = $data->nama_jabatan ;
                    @endphp
                @else
                    @php
                        $jabatan = $jabatan .' / '. $data->nama_jabatan;
                    @endphp
                @endif
            @endif

            @if($unitkerja == '')
                    @php
                        $unitkerja = $data->nama_unit_kerja;
                    @endphp
                @else
                    @php
                        $unitkerja = $unitkerja . ' / ' . $data->nama_unit_kerja;
                    @endphp
                @endif


        @endforeach

        @foreach ($pegawai as $data)

            <div class="row rowdata">
                <div class="col-sm-2">
                    <strong>NIP</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $data->nip }}
                </div>

                <div class="col-sm-2">
                    <strong>Pangkat</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $data->nama_pangkat }}
                </div>
            </div>

            <div class="row rowdata">
                <div class="col-sm-2">
                    <strong>Nama Pegawai</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $data->nama_depan . ' ' . $data->nama_belakang }}
                </div>

                <div class="col-sm-2">
                    <strong>Nama Golongan</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $data->nama_golongan }}
                </div>
            </div>

            <div class="row rowdata">
                <div class="col-sm-2">
                    <strong>Tempat & Tanggal Lahir</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d/m/Y') }}
                </div>

                <div class="col-sm-2">
                    <strong>Jenis Jabatan</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $data->jenis_jabatan }}
                </div>

            </div>

            <div class="row rowdata">
                <div class="col-sm-2">
                    <strong>Unit Kerja</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $unitkerja  }}
                </div>

                <div class="col-sm-2">
                    <strong>Nama Jabatan</strong>
                </div>
                <div class="col-sm-4">
                    : {{ $jabatan }}
                </div>
            </div>

            <div class="row rowdata">
                <div class="col-sm-2">
                    <strong>Kuota Ijin Kehadiran dan Presensi Tidak Tercatat</strong>
                </div>
                <div class="col-sm-4">
                    :
                    @if($totalKuota>=3)
                        <strong class="btn btn-danger">{{ $totalKuota  }} dari 3</strong>
                    @else
                        <strong class="btn btn-success">{{ $totalKuota  }} dari 3</strong>
                    @endif
                </div>
            </div>

            @break
        @endforeach

        {{-- <div class="row rowdata">
            <div class="col-sm-2">
                <strong>Unit Kerja</strong>
            </div>

            <div class="col-sm-10">
                <select class="form-control" id="jabatan_unit_kerja_id" name="jabatan_unit_kerja_id" required>
                    @foreach ($pegawai as $data)
                        <option value="{{ $data->id }}" {{ (old('jabatan_unit_kerja_id') == $data->id || $data->is_plt == 0)? 'selected' : '' }}>{{ $data->nama_unit_kerja }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}


    </div>
</div>
