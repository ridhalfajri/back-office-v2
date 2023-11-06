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
    <link rel="stylesheet" href="assets/css/theme1.css" id="theme_stylesheet') }}"/>
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
            <div class="container custom-background-color">
                <div class="hleft" style="background-color: #ffffff">
                    <a class="header-brand" href="/"><img src="bsn-logo.png" alt="Logo BSN"></a>
                </div>
                <div class="hright">
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i
                                class="fa  fa-align-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="left-sidebar" class="sidebar" style="background-color: hsl(203, 76%, 70%) !important;
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#78c0ec');
        background-image: -khtml-gradient(linear, left top, left bottom, from(#ffffff), to(#78c0ec));
        background-image: -moz-linear-gradient(top, #ffffff, #78c0ec);
        background-image: -ms-linear-gradient(top, #ffffff, #78c0ec);
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #78c0ec));
        background-image: -webkit-linear-gradient(top, #ffffff, #78c0ec);
        background-image: -o-linear-gradient(top, #ffffff, #78c0ec);
        background-image: linear-gradient(#ffffff, #78c0ec);
        border-color: #78c0ec #78c0ec hsl(203, 76%, 62.5%);
        color: #333 !important;
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.49);
        -webkit-font-smoothing: antialiased;
        color: whitesmoke;
        font-weight: bold;
        font-family: 'Open Sans', sans-serif;
        padding-bottom:5px;">
            <h5 class="brand-name">KEPEGAWAIAN</h5>
            @include('partials.sidebar')
        </div>
        <div class="page">
            @include('partials.topbar')
            <nav aria-label="breadcrumb" style="background-color:  #78c0ec">
                @stack('breadcrumb')
            </nav>
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
