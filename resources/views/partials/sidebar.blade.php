<nav id="left-sidebar-nav" class="sidebar-nav">
    <ul class="metismenu">
        <li class="g_heading">Directories</li>
        <li><a href="#"><i class="icon-home"></i><span>Dashboard</span></a></li>
        <li><a href="{{ route('pegawai.index') }}"><i class="icon-users"></i><span>Pegawai</span></a></li>
        <li><a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i><span>Gaji Pegawai</span></a></li>
        <li><a href="{{ route('jabatan-tukin.index') }}"><i class="fa fa-money"></i><span>Tunjangan Kinerja</span></a>
        </li>
        <li><a href="{{ route('jabatan-unit-kerja.index') }}"><i class="fa fa-snowflake-o"></i><span>Jabatan Unit
                    Kerja</span></a></li>
        <li><a href="{{ route('presensi.index') }}"><i class="fa fa-clock-o"></i><span>Presensi</span></a></li>

        <li class="{{ request()->segment(1) == 'cuti' ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><i class="icon-doc"></i><span>Cuti</span></a>
            <ul class="{{ request()->segment(1) == 'cuti' ? 'active' : '' }}">
                <li class="{{ request()->segment(2) == 'riwayat_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.riwayat-cuti') }}">Riwayat Cuti</a></li>
                <li class="{{ request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.saldo-cuti') }}">Saldo Cuti</a></li>

                @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 ||
                        auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                    <li class="{{ request()->segment(2) == 'pengajuan_masuk' ? 'active' : '' }}"><a
                            href="{{ route('cuti.pengajuan-masuk') }}">Pengajuan Masuk</a></li>
                @endif
                @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                    <li class="{{ request()->segment(2) == 'pengajuan_masuk_sdmoh' ? 'active' : '' }}"><a
                            href="{{ route('cuti.pengajuan-masuk-sdmoh') }}">Pengajuan SDMOH</a></li>
                    <li class="{{ request()->segment(2) == 'saldo_cuti_pegawai' ? 'active' : '' }}"><a
                            href="{{ route('cuti.saldo-cuti-pegawai') }}">Saldo Cuti Pegawai</a></li>
                @endif
            </ul>
        </li>
        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
            <li class="{{ request()->segment(1) == 'penghasilan' ? 'active' : '' }}"><a
                    href="{{ route('penghasilan.index') }}"><i
                        class="fa fa-credit-card"></i><span>Penghasilan</span></a>
            </li>
        @endif

    </ul>
</nav>
