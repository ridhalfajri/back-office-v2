<nav id="left-sidebar-nav" class="sidebar-nav">
    <ul class="metismenu">
        {{-- PERSONAL --}}
        <li class="g_heading">Personal</li>
        <li class="{{ request()->segment(2) == auth()->user()->pegawai_id ? 'active' : '' }}"><a
                href="{{ route('pegawai.show', auth()->user()->pegawai_id) }}"><i
                    class="icon-home"></i><span>Profile</span></a>
        </li>
        {{-- <li class="{{ request()->segment(3) == auth()->user()->pegawai_id ? 'active' : '' }}"><a
                href="{{ route('penghasilan.show', auth()->user()->pegawai_id) }}"><i
                    class="icon-bar-chart"></i><span>Penghasilan</span></a>
        </li>
        <li class="{{ Request::is('riwayat-thr*') ? 'active' : '' }}"><a href="{{ route('riwayat-thr.index') }}"><i
                    class="icon-notebook"></i><span>Riwayat THR</span></a>
        </li>

        <li class="{{ Request::is('riwayat-gajiplus*') ? 'active' : '' }}"><a
                href="{{ route('riwayat-gajiplus.index') }}"><i class="fa fa-money"></i><span>Riwayat Gaji-13</span></a>
        </li> --}}

        {{-- <li
            class="{{ request()->segment(2) == 'riwayat-jabatan' && request()->segment(1) == auth()->user()->pegawai_id ? 'active' : '' }}">
            <a href="{{ route('riwayat-jabatan.index') }}"><i class="icon-bar-chart"></i><span>Riwayat Jabatan</span></a>
        </li> --}}
        <li
            class="{{ request()->segment(2) == 'riwayat_cuti' || request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><i class="icon-rocket"></i><span>Cuti</span></a>
            <ul
                class="{{ request()->segment(2) == 'riwayat_cuti' || request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}">
                <li class="{{ request()->segment(2) == 'riwayat_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.riwayat-cuti') }}">Pengajuan Cuti</a></li>
                <li class="{{ request()->segment(2) == 'saldo_cuti' ? 'active' : '' }}"><a
                        href="{{ route('cuti.saldo-cuti') }}">Saldo Cuti</a></li>

            </ul>
        </li>

        <li class="{{ request()->segment(1) == 'presensi' ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><i class="fa fa-clock-o"></i><span>Presensi</span></a>
            <ul class="{{ request()->segment(1) == 'presensi' ? 'active' : '' }}">
                <li class="{{ request()->segment(2) == 'presensiku' ? 'active' : '' }}">
                    <a href="{{ route('presensiku.index') }}">Presensiku </span></a>
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
        <li class="{{ Request::is('pengajuan-pmk*') ? 'active' : '' }}"><a
                href="{{ route('pengajuan-pmk.index') }}"><i class="icon-plus"></i><span>Pengajuan Peninjauan Masa
                    Kerja</span></a>
        </li>

        <li class="{{ Request::is('pengajuan-bpjs*') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="has-arrow"><i class="icon-umbrella"></i><span>Pengajuan BPJS</span></a>
            <ul class="sub-menu js__content">

                <li class="{{ Request::is('pengajuan-bpjs/pengajuan-regular-bpjs*') ? 'active' : '' }}"><a
                        href="{{ route('pengajuan-regular-bpjs.index') }}">Pengajuan
                        BPJS Regular</a>
                </li>

                <li class="{{ Request::is('pengajuan-bpjs/pengajuan-tambahan-bpjs*') ? 'active' : '' }}"><a
                        href="{{ route('pengajuan-tambahan-bpjs.index') }}">Pengajuan
                        BPJS Keluarga Lain</a>
                </li>

            </ul>
        </li>

        <li class="{{ Request::is('pengajuan-tunjangan-keluarga*') ? 'active' : '' }}"><a
                href="{{ route('pengajuan-tunjangan-keluarga.index') }}"><i class="icon-wallet"></i><span>
                    Pengajuan Tunjangan Keluarga (KP4)</span></a>
        </li>

        <li class="{{ Request::is('grade-tukin*') ? 'active' : '' }}"><a href="{{ route('grade-tukin.index') }}"><i
                    class="icon-layers"></i><span>Info Grade Tukin</span></a>
        </li>

        {{-- ESSELON 2 --}}
        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 ||
                auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
            <li class="g_heading">Esselon II</li>
            <li class="{{ request()->segment(2) == 'pengajuan_masuk' ? 'active' : '' }}"><a
                    href="{{ route('cuti.pengajuan-masuk') }}"><i class="icon-disc"></i><span>Pengajuan
                        Cuti</span></a></li>
            <li
                class="{{ request()->segment(1) == 'esselon2' && request()->segment(2) == 'pegawai' ? 'active' : '' }}">
                <a href="{{ route('pegawai.index-esselon') }}"><i class="icon-users"></i><span>Staff</span></a>
            </li>
            {{-- <li
                class="{{ request()->segment(1) == 'esselon2' && request()->segment(2) == 'penghasilan' ? 'active' : '' }}">
                <a href="{{ route('penghasilan.index-esselon') }}"><i class="icon-book-open"></i><span>Penghasilan
                        Staff</span></a>
            </li> --}}
        @endif

        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
                auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2)
            <li class="{{ request()->segment(1) == 'presensi-pegawai' ? 'active' : '' }}">
                <a href="{{ route('presensi-pegawai') }}"><i class="icon-calendar"></i><span>Presensi
                        Pegawai</span></a>
            </li>
        @endif


        {{-- ESSELON 1 --}}

        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1)
            <li class="g_heading">Esselon I</li>
            <li class="{{ request()->segment(2) == 'pengajuan_masuk' ? 'active' : '' }}"><a
                    href="{{ route('cuti.pengajuan-masuk') }}"><i class="icon-call-end"></i><span>Pengajuan
                        Cuti</span></a></li>
        @endif

        {{-- KABIRO SDMOH --}}
        @if (auth()->user()->pegawai->jabatan_kabiro != null)
            <li class="g_heading">Kabiro</li>
            <li class="{{ request()->segment(2) == 'pengajuan_masuk_sdmoh' ? 'active' : '' }}">
                <a href="{{ route('cuti.pengajuan-masuk-sdmoh') }}"><i class="icon-check"></i><span>Approval Cuti
                        Kabiro</span></a>
                {{-- TRANSAKSI --}}
            <li class="g_heading">Transaksi</li>

            <li class="{{ request()->segment(2) == 'presensi-pegawai' ? 'active' : '' }}">
                <a href="{{ route('presensi-pegawai') }}"><i class="icon-calendar"></i><span>Presensi
                        Pegawai</span></a>
            </li>
            {{-- <li class="{{ Request::is('kalkulasi*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><i class="icon-calculator"></i><span>Kalkulasi</span></a>
                <ul class="sub-menu js__content">
                    <li class="{{ Request::is('kalkulasi/pegawai-riwayat-umak*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai-riwayat-umak.index') }}">Uang Makan Pegawai</a>
                    </li>

                    <li class="{{ Request::is('kalkulasi/pegawai-riwayat-thr*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai-riwayat-thr.index') }}">THR Pegawai</a>
                    </li>

                    <li class="{{ Request::is('kalkulasi/pegawai-riwayat-gajiplus*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai-riwayat-gajiplus.index') }}">Gaji-13 Pegawai</a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="{{ request()->segment(1) == 'penghasilan' ? 'active' : '' }}"><a
                    href="{{ route('penghasilan.index') }}"><i class="icon-briefcase"></i><span>Penghasilan</span></a>
            </li> --}}
            <li class="{{ Request::is('pegawai-riwayat-golongan*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-riwayat-golongan.index') }}"><i class="icon-folder-alt"></i><span>Riwayat
                        Golongan Pegawai</span></a></li>
            <li class="{{ Request::is('pegawai-penilaian-kinerja*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-penilaian-kinerja.index') }}"><i class="icon-film"></i><span>Penilaian
                        Kinerja Pegawai</span>
                </a>
            </li>

            <li class="{{ request()->segment(2) == 'pre-tubel' ? 'active' : '' }}">
                <a href="{{ route('pre-tubel.index') }}"><i class="icon-graduation"></i>Tugas belajar</span></a>
            </li>

            <li class="{{ Request::is('pegawai-tambahan-mk*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-tambahan-mk.index') }}"><i class="icon-note"></i><span>Approval Peninjauan
                        Masa Kerja
                        Pegawai</span></a></li>

            <li class="{{ Request::is('approval-bpjs*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><i class="icon-umbrella"></i><span>Approval
                        BPJS</span></a>
                <ul class="sub-menu js__content">
                    <li class="{{ Request::is('approval-bpjs/pegawai-regular-bpjs*') ? 'active' : '' }}"><a
                            href="{{ route('pegawai-regular-bpjs.index') }}">Approval
                            BPJS Regular</a>
                    </li>

                    <li class="{{ Request::is('approval-bpjs/pegawai-tambahan-bpjs*') ? 'active' : '' }}"><a
                            href="{{ route('pegawai-tambahan-bpjs.index') }}">Approval
                            BPJS Keluarga Lain</a>
                    </li>

                </ul>
            </li>

            <li class="{{ Request::is('pegawai-tunjangan-keluarga*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-tunjangan-keluarga.index') }}"><i class="icon-wallet"></i><span>Approval
                        Tunjangan Keluarga (KP4)</span></a></li>

            {{-- MASTER     --}}
            <li class="g_heading">Master Data</li>
            <li class="{{ request()->segment(2) == 'saldo_cuti_pegawai' ? 'active' : '' }}">
                <a href="{{ route('cuti.saldo-cuti-pegawai') }}"><i class="icon-puzzle"></i><span>Saldo Cuti
                        Pegawai</span></a>
            </li>
            <li class="{{ request()->segment(1) == 'pegawai' ? 'active' : '' }}">
                <a href="{{ route('pegawai.index') }}"><i class="icon-users"></i><span>Pegawai</span></a>
            </li>
            <li class="{{ Request::is('master/status-pegawai*') ? 'active' : '' }}"><a
                    href="{{ route('status-pegawai.index') }}"><i class="icon-target"></i><span>Status
                        Pegawai</span></a></li>
            <li class="{{ Request::is('master/unit-kerja*') ? 'active' : '' }}"><a
                    href="{{ route('unit-kerja.index') }}"><i class="icon-users"></i><span>Unit Kerja</span></a></li>
            <li class="{{ Request::is('master/tukin*') ? 'active' : '' }}"><a href="{{ route('tukin.index') }}"><i
                        class="icon-directions"></i><span>Grade Tukin</span></a></li>
            <li class="{{ Request::is('master/uang-makan*') ? 'active' : '' }}"><a
                    href="{{ route('uang-makan.index') }}"><i class="icon-wallet"></i><span>Uang Makan</span></a>
            </li>
            <li class="{{ Request::is('master/tunjangan-beras*') ? 'active' : '' }}"><a
                    href="{{ route('tunjangan-beras.index') }}"><i class="icon-support"></i><span>Tunjangan
                        Beras</span></a></li>
            <li class="{{ Request::is('master/aturan-thr-gajiplus*') ? 'active' : '' }}"><a
                    href="{{ route('aturan-thr-gajiplus.index') }}"><i class="icon-envelope-letter"></i><span>Aturan
                        THR dan
                        Gaji-13</span></a></li>
            <li class="{{ Request::is('master/pegawai-rekening*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-rekening.index') }}"><i class="fa fa-money"></i><span>Rekening
                        Pegawai</span></a></li>
            <li class="{{ Request::is('master/pegawai-hirarki*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-hirarki.index') }}"><i class="icon-list"></i><span>Hirarki
                        Pegawai</span></a></li>

            <li><a href="{{ route('gaji.index') }}"><i class="icon-social-dropbox"></i><span>Gaji Pegawai</span></a>
            </li>
            <li><a href="{{ route('jabatan-tukin.index') }}"><i class="icon-equalizer"></i><span>Tunjangan
                        Kinerja Jabatan</span></a>
            </li>


            <li class="{{ request()->segment(2) == 'pre-jam-kerja' ? 'active' : '' }}">
                <a href="{{ route('pre-jam-kerja.index') }}"><i class="icon-wrench"></i>Pengaturan Jam
                    Kerja</span></a>
            </li>

            <li class="{{ request()->segment(2) == 'hari-libur' ? 'active' : '' }}">
                <a href="{{ route('hari-besar.index') }}"><i class="icon-film"></i>Daftar Hari Besar</span></a>
            </li>

            <li><a href="{{ route('jabatan-unit-kerja.index') }}"><i class="fa fa-snowflake-o"></i><span>Jabatan Unit
                        Kerja</span></a></li>
        @endif

        {{--  ADMIN SDM --}}
        @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 7)
            {{-- TRANSAKSI --}}
            <li class="g_heading">Transaksi</li>

            <li class="{{ request()->segment(2) == 'presensi-pegawai' ? 'active' : '' }}">
                <a href="{{ route('presensi-pegawai') }}"><i class="fa fa-clock-o"></i><span>Presensi
                        Pegawai</span></a>
            </li>
            {{-- <li class="{{ Request::is('kalkulasi*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><i class="fa fa-money"></i><span>Kalkulasi</span></a>
                <ul class="sub-menu js__content">
                    <li class="{{ Request::is('kalkulasi/pegawai-riwayat-umak*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai-riwayat-umak.index') }}">Uang Makan Pegawai</a>
                    </li>

                    <li class="{{ Request::is('kalkulasi/pegawai-riwayat-thr*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai-riwayat-thr.index') }}">THR Pegawai</a>
                    </li>

                    <li class="{{ Request::is('kalkulasi/pegawai-riwayat-gajiplus*') ? 'active' : '' }}">
                        <a href="{{ route('pegawai-riwayat-gajiplus.index') }}">Gaji-13 Pegawai</a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="{{ request()->segment(1) == 'penghasilan' ? 'active' : '' }}"><a
                    href="{{ route('penghasilan.index') }}"><i
                        class="fa fa-credit-card"></i><span>Penghasilan</span></a>
            </li> --}}
            <li class="{{ Request::is('pegawai-riwayat-golongan*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-riwayat-golongan.index') }}"><i
                        class="fa fa-credit-card"></i><span>Riwayat
                        Golongan Pegawai</span></a></li>
            <li class="{{ request()->segment(2) == 'pre-tubel' ? 'active' : '' }}">
                <a href="{{ route('pre-tubel.index') }}"><i class="fa fa-graduation-cap"></i>Tugas
                    belajar</span></a>
            </li>

            <li class="{{ Request::is('pegawai-tambahan-mk*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-tambahan-mk.index') }}"><i class="fa fa-plus"></i><span>Approval PMK
                        Pegawai</span></a></li>

            <li class="{{ Request::is('approval-bpjs*') ? 'active' : '' }}">
                <a href="javascript:void(0)" class="has-arrow"><i class="icon-umbrella"></i><span>Approval
                        BPJS</span></a>
                <ul class="sub-menu js__content">

                    <li class="{{ Request::is('approval-bpjs/pegawai-regular-bpjs*') ? 'active' : '' }}"><a
                            href="{{ route('pegawai-regular-bpjs.index') }}">Approval
                            BPJS Regular</a>
                    </li>

                    <li class="{{ Request::is('approval-bpjs/pegawai-tambahan-bpjs*') ? 'active' : '' }}"><a
                            href="{{ route('pegawai-tambahan-bpjs.index') }}">Approval
                            BPJS Keluarga Lain</a>
                    </li>

                </ul>
            </li>

            <li class="{{ Request::is('pegawai-tunjangan-keluarga*') ? 'active' : '' }}"><a
                    href="{{ route('pegawai-tunjangan-keluarga.index') }}"><i class="icon-wallet"></i><span>Approval
                        Tunjangan Keluarga (KP4)</span></a></li>

            {{-- MASTER     --}}
            <li class="g_heading">Master Data</li>
            <li class="{{ request()->segment(2) == 'saldo_cuti_pegawai' ? 'active' : '' }}">
                <a href="{{ route('cuti.saldo-cuti-pegawai') }}"><i class="icon-users"></i><span>Saldo Cuti
                        Pegawai</span></a>
            </li>
            <li class="{{ request()->segment(1) == 'pegawai' ? 'active' : '' }}">
                <a href="{{ route('pegawai.index') }}"><i class="icon-users"></i><span>Pegawai</span></a>
            </li>
            <li class="{{ Request::is('master/status-pegawai*') ? 'active' : '' }}"><a
                    href="{{ route('status-pegawai.index') }}"><i class="icon-users"></i><span>Status
                        Pegawai</span></a></li>
            <li class="{{ Request::is('master/unit-kerja*') ? 'active' : '' }}"><a
                    href="{{ route('unit-kerja.index') }}"><i class="icon-users"></i><span>Unit Kerja</span></a>
            </li>

            <li class="{{ Request::is('master/tukin*') ? 'active' : '' }}"><a href="{{ route('tukin.index') }}"><i
                        class="fa fa-money"></i><span>Grade Tukin</span></a></li>
            <li class="{{ Request::is('master/uang-makan*') ? 'active' : '' }}"><a
                    href="{{ route('uang-makan.index') }}"><i class="fa fa-money"></i><span>Uang Makan</span></a>
            </li>
            <li class="{{ Request::is('master/tunjangan-beras*') ? 'active' : '' }}"><a
                    href="{{ route('tunjangan-beras.index') }}"><i class="fa fa-money"></i><span>Tunjangan
                        Beras</span></a></li>
            <li class="{{ Request::is('master/aturan-thr-gajiplus*') ? 'active' : '' }}"><a
                    href="{{ route('aturan-thr-gajiplus.index') }}"><i class="fa fa-money"></i><span>Aturan THR dan
                        Gaji-13</span></a></li>

            <li><a href="{{ route('gaji.index') }}"><i class="fa fa-money"></i><span>Gaji Pegawai</span></a></li>
            <li><a href="{{ route('jabatan-tukin.index') }}"><i class="fa fa-money"></i><span>Tunjangan
                        Kinerja Jabatan</span></a>
            </li>


            <li class="{{ request()->segment(2) == 'pre-jam-kerja' ? 'active' : '' }}">
                <a href="{{ route('pre-jam-kerja.index') }}"><i class="fa fa-cogs"></i>Pengaturan Jam
                    Kerja</span></a>
            </li>

            <li class="{{ request()->segment(2) == 'hari-libur' ? 'active' : '' }}">
                <a href="{{ route('hari-besar.index') }}"><i class="fa fa-cogs"></i>Daftar Hari Besar</span></a>
            </li>

            <li><a href="{{ route('jabatan-unit-kerja.index') }}"><i class="fa fa-snowflake-o"></i><span>Jabatan
                        Unit
                        Kerja</span></a></li>
        @endif

    </ul>
</nav>
