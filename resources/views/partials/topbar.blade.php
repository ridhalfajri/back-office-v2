<div id="page_top" class="section-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="left">
                <h1 class="page-title">{{ $title }}</h1>
            </div>
            <div class="right">
                <div class="notification d-flex">
                    <div class="dropdown d-flex">
                        <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1"
                            data-toggle="dropdown">{{ auth()->user()->pegawai->nama }}</a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('pegawai.show', auth()->user()->pegawai_id) }}"><i
                                    class="dropdown-icon fe fe-user"></i>
                                Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout.ldap') }}"><i
                                    class="dropdown-icon fe fe-log-out"></i> Sign
                                out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
