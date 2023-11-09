<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="icon" href="favicon.ico" type="image/x-icon') }}"/>

    <title>:: Back-Office</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />

    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/charts-c3/c3.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jvectormap-2.0.3.css') }}" />

    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/theme1.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

    @stack('style')
</head>

<body class="font-opensans">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>
    <!-- Overlay For Sidebars -->

    <div id="main_content" >
        <div id="header_top" class="header_top">
            <div class="container">
                <div class="hleft">
                    <a class="header-brand" href="/"><img src="/bsn-logo.png" alt="Logo BSN"></a>
                </div>
                <div class="hright">
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i
                                class="fa  fa-align-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="left-sidebar" class="sidebar">
            <h5 class="brand-name">KEPEGAWAIAN</h5>
            <hr>
            @include('partials.side-bar')
        </div>
        <div class="page">
            @include('partials.top-bar')
            <div class="card">
                <nav id="navbreadcrumb" aria-label="breadcrumb">
                    @stack('breadcrumb')
                </nav>
            </div>
            @yield('content')
        </div>
    </div>


    <script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/counterup.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/jvectormap1.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>


    <script src="{{ asset('assets/js/core.js') }}"></script>

    <script>
        $(document).ready(function() {
            var activeLi = localStorage.getItem('activeLi');
            if (activeLi) {
                $('ul.metismenu li').removeClass('active');
                $('ul.metismenu li:eq(' + activeLi + ')').addClass('active');
            }

            $('ul.metismenu li').click(function() {
                $('ul.metismenu li.active').removeClass('active');
                $(this).addClass('active');
                localStorage.setItem('activeLi', $(this).index());
            });
        });
    </script>

    @stack('script')
</body>

</html>
