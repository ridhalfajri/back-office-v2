<nav id="left-sidebar-nav" class="sidebar-nav">
    <ul class="metismenu">
        {{-- PERSONAL --}}
        <li class="g_heading">Personal</li>
        <li class="{{ request()->segment(2) == auth()->user()->pegawai_id ? 'active' : '' }}"><a
                href="{{ route('pegawai.show', auth()->user()->pegawai_id) }}"><i
                    class="icon-home"></i><span>Profile</span></a></li>
        <li class="{{ request()->segment(3) == auth()->user()->pegawai_id ? 'active' : '' }}"><a
                href="{{ route('penghasilan.show', auth()->user()->pegawai_id) }}"><i
                    class="icon-bar-chart"></i><span>Penghasilan</span></a></li>
        <li
            class="{{ request()->segment(2) == 'riwayat-jabatan' && request()->segment(1) == auth()->user()->pegawai_id ? 'active' : '' }}">
            <a href="{{ route('riwayat-jabatan.index') }}"><i class="icon-list"></i><span>Riwayat Jabatan</span></a>
        </li>
        <li
            class="{{ request()->segment(2) == 'riwayat_cuti' || request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><i class="icon-doc"></i><span>Cuti</span></a>
            <ul
                class="{{ request()->segment(2) == 'riwayat_cuti' || request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}">
                <li class="{{ request()->segment(2) == 'riwayat_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.riwayat-cuti') }}">Riwayat Cuti</a></li>
                <li class="{{ request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.saldo-cuti') }}">Saldo Cuti</a></li>

            </ul>
        </li>

        <li class="{{ request()->segment(1) == 'presensi' ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><i class="fa fa-clock-o"></i><span>Presensi</span></a>
            <ul class="{{ request()->segment(1) == 'presensi' ? 'active' : '' }}">
                <li class="{{ request()->segment(2) == 'presensi-pegawai' ? 'active' : '' }}">
                    <a href="{{ route('presensi-pegawai.index') }}">Presensiku </span></a>
                </li>

                <li class="{{ request()->segment(2) == 'pre-ijin' ? 'active' : '' }}">
                    <a href="{{ route('pre-ijin.index') }}">Ijin Kehadiran</span></a>
                </li>

                <li class="{{ request()->segment(2) == 'pre-tak-tercatat' ? 'active' : '' }}">
                    <a href="{{ route('pre-tak-tercatat.index') }}">Presensi Tidak Tercatat</span></a>
                </li>

                <li class="{{ request()->segment(2) == 'pre-dinas-luar' ? 'active' : '' }}">
                    <a href="{{ route('pre-dinas-luar.index') }}">Dinas Luar</span></a>
                </li>

            </ul>
        </li>

        {{-- ESSELON 2 --}}
        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 ||
                auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
            <li class="g_heading">Esselon II</li>
            <li class="{{ request()->segment(2) == 'pengajuan_masuk' ? 'active' : '' }}"><a
                    href="{{ route('cuti.pengajuan-masuk') }}"><i class="icon-call-end"></i><span>Pengajuan
                        Cuti</span></a></li>
            <li class="{{ request()->segment(1) == 'esselon2' ? 'active' : '' }}">
                <a href="{{ route('pegawai.index-esselon') }}"><i class="icon-users"></i><span>Staff</span></a>
            </li>
        @endif
        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
            <li class="g_heading">Kabiro</li>
            <li class="{{ request()->segment(1) == 'pegawai' ? 'active' : '' }}">
                <a href="{{ route('pegawai.index') }}"><i class="icon-users"></i><span>Pegawai</span></a>
            </li>
            <li><a href="{{ route('presensi-pegawai.index') }}"><i class="fa fa-clock-o"></i><span>Presensi</span></a></li>
            <li
                class="{{ request()->segment(2) == 'pengajuan_masuk_sdmoh' || request()->segment(2) == 'saldo_cuti_pegawai' ? 'active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><i class="icon-doc"></i><span>Cuti Pegawai</span></a>
                <ul
                    class="{{ request()->segment(2) == 'pengajuan_masuk_sdmoh' || request()->segment(2) == 'saldo_cuti_pegawai' ? 'active' : '' }}">
                    <li class="{{ request()->segment(2) == 'pengajuan_masuk_sdmoh' ? 'active' : '' }}"><a
                            href="{{ route('cuti.pengajuan-masuk-sdmoh') }}">Pengajuan SDMOH</a></li>
                    <li class="{{ request()->segment(2) == 'saldo_cuti_pegawai' ? 'active' : '' }}"><a
                            href="{{ route('cuti.saldo-cuti-pegawai') }}">Saldo Cuti Pegawai</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('kalkulasi*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><i class="fa fa-money"></i><span>Kalkulasi</span></a>
                <ul class="sub-menu js__content">
                    <li class="{{ Request::is('kalkulasi/pegawai-riwayat-umak*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai-riwayat-umak.index') }}">Pegawai Riwayat Uang Makan</a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->segment(1) == 'penghasilan' ? 'active' : '' }}"><a
                    href="{{ route('penghasilan.index') }}"><i
                        class="fa fa-credit-card"></i><span>Penghasilan</span></a>
            </li>
        @endif

        {{-- KABIRO SDMOH --}}
        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
            <li class="g_heading">Master Data</li>
            <li><a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i><span>Gaji Pegawai</span></a></li>
            <li><a href="{{ route('jabatan-tukin.index') }}"><i class="fa fa-money"></i><span>Tunjangan
                        Kinerja</span></a>
            </li>
            <li class="{{ request()->segment(2) == 'pre-tubel' ? 'active' : '' }}">
                <a href="{{ route('pre-tubel.index') }}"><i class="fa fa-graduation-cap"></i>Tugas belajar</span></a>
            </li>

            <li class="{{ request()->segment(2) == 'pre-jam-kerja' ? 'active' : '' }}">
                <a href="{{ route('pre-jam-kerja.index') }}"><i class="fa fa-cogs"></i>Pengaturan Jam Kerja</span></a>
            </li>
            <li><a href="{{ route('jabatan-unit-kerja.index') }}"><i class="fa fa-snowflake-o"></i><span>Jabatan Unit
                        Kerja</span></a></li>
            <li class="{{ Request::is('master*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><i class="icon-doc"></i><span>Master</span></a>
                <ul class="sub-menu js__content">
                    <li class="{{ Request::is('master/tukin*') ? 'active' : '' }}"><a
                            href="{{ route('tukin.index') }}">Tukin</a></li>
                    <li class="{{ Request::is('master/uang-makan*') ? 'active' : '' }}"><a
                            href="{{ route('uang-makan.index') }}">Uang Makan</a></li>
                    <li class="{{ Request::is('master/unit-kerja*') ? 'active' : '' }}"><a
                            href="{{ route('unit-kerja.index') }}">Unit Kerja</a></li>
                    <li class="{{ Request::is('master/status-pegawai*') ? 'active' : '' }}"><a
                            href="{{ route('status-pegawai.index') }}">Status Pegawai</a></li>
                </ul>
            </li>
        @endif

    </ul>
</nav>

