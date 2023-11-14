<nav id="left-sidebar-nav" class="sidebar-nav">
    <ul class="metismenu">
        <li class="g_heading">Directories</li>
        <li><a href="#"><i class="icon-home"></i><span>Dashboard</span></a></li>
        <li><a href="{{ route('pegawai.index') }}"><i class="icon-users"></i><span>Pegawai</span></a></li>
        <li><a href="{{ route('gaji.index') }}"><i class="icon-money"></i><span>Gaji Pegawai</span></a></li>
        <li><a href="{{ route('jabatan-tukin.index') }}"><i class="icon-money"></i><span>Jabatan Tukin</span></a></li>

        <li>
            <a href="javascript:void(0)" class="has-arrow"><i class="icon-lock"></i><span>Authentication</span></a>
            <ul>
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
                <li><a href="#">Forgot password</a></li>
                <li><a href="#">404 error</a></li>
                <li><a href="#">500 error</a></li>
            </ul>
        </li>
    </ul>
</nav>
