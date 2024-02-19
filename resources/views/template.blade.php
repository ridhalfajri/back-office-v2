<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Crush On The most popular Admin Dashboard template and ui kit">
    <meta name="author" content="Back Office">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <title>BSN</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />


    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" /> --}}

    @stack('style')
</head>

<body class="font-opensans">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>
    <!-- Overlay For Sidebars -->

    <div id="main_content">
        <div id="header_top" class="header_top">
            <div class="container">
                <div class="hleft">
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i
                                class="fa fa-align-left"></i></a>
                    </div>

                    {{-- <a class="header-brand" href="{{ route('pegawai.show', auth()->user()->pegawai_id) }}">
                        <img  alt=""> 
                        <i class="fa fa-dashboard brand-logo"></i></a>
                    </a>--}}

                    <a href="{{ route('pegawai.show', auth()->user()->pegawai_id) }}" class="nav-link user_btn">
                        <img class="avatar" src="{{ asset('logo-user.png') }}"
                        alt="" data-toggle="tooltip"
                        data-placement="right" title="Profil Saya"/></a>
                </div>
                {{-- <div class="hright">
                   
                </div> --}}
            </div>
        </div>
        <div id="left-sidebar" class="sidebar ">
            <h5 class="brand-name">BackOffice</h5>
            @include('partials.sidebar')
        </div>
        <div class="page">
            @include('partials.topbar')
            @stack('breadcrumb')
            @yield('content')
            @stack('modal')
        </div>
    </div>

    <script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/core.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script> --}}

    @stack('script')
</body>

</html>
