<nav id="left-sidebar-nav" class="sidebar-nav">
    <ul class="metismenu">
        <li class="g_heading">Directories</li>
        <li><a href="#"><i class="icon-home"></i><span>Dashboard</span></a></li>
        <li><a href="{{ route('pegawai.index') }}"><i class="icon-users"></i><span>Pegawai</span></a></li>
        <li><a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i><span>Gaji Pegawai</span></a></li>
        <li><a href="{{ route('jabatan-tukin.index') }}"><i class="fa fa-money"></i><span>Tunjangan Kinerja</span></a></li>
        <li><a href="{{ route('jabatan-unit-kerja.index') }}"><i class="fa fa-snowflake-o"></i><span>Jabatan Unit Kerja</span></a></li>

        <li class="{{ request()->segment(1) == 'cuti' ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><i class="icon-doc"></i><span>Cuti</span></a>
            <ul class="{{ request()->segment(1) == 'cuti' ? 'active' : '' }}">
                {{-- <li class="{{ request()->segment(2) == 'pengajuan_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.pengajuan-cuti') }}">Pengajuan Cuti</a></li> --}}
                <li class="{{ request()->segment(2) == 'riwayat_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.riwayat-cuti') }}">Riwayat Cuti</a></li>
                <li class="{{ request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.saldo-cuti') }}">Saldo Cuti</a></li>
            </ul>
        </li>
    </ul>
</nav>
