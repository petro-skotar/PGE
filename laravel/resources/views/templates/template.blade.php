<!DOCTYPE html>
<html lang="{{ $LANG }}">
<head>
{!! $SETTING['code_head']['val'] !!}

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="{{ $article->details_one->description }}"/>
    <meta name="author" content="Petro Skotar, web developer"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $article->details_one->title }}</title>

	<base href="https://<?php echo $_SERVER['HTTP_HOST']; ?>" />

    @include('templates.components.head-sitemap')

    <link rel="icon" type="image/png" href="{{ asset('templates/pgeconstruction/images/favicons/favicon-48x48.png') }}" sizes="48x48" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('templates/pgeconstruction/images/favicons/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('templates/pgeconstruction/images/favicons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('templates/pgeconstruction/images/favicons/apple-touch-icon.png') }}" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- Stylesheet -->
    <link href="{{ asset('templates/pgeconstruction/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/pgeconstruction/css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templates/pgeconstruction/css/javascript-plugins-bundle.css') }}" rel="stylesheet"/>

    <!-- CSS | menuzord megamenu skins -->
    <link href="{{ asset('templates/pgeconstruction/js/menuzord/css/menuzord.css') }}" rel="stylesheet"/>

    <!-- CSS | Main style file -->
    <link href="{{ asset('templates/pgeconstruction/css/style-main.css') }}" rel="stylesheet" type="text/css">
    <link id="menuzord-menu-skins" href="{{ asset('templates/pgeconstruction/css/menuzord-skins/menuzord-rounded-boxed.css') }}" rel="stylesheet"/>

    <!-- CSS | Responsive media queries -->
    <link href="{{ asset('templates/pgeconstruction/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->

    <!-- CSS | Theme Color -->
    <link href="{{ asset('templates/pgeconstruction/css/colors/theme-skin-color-set1.css') }}" rel="stylesheet" type="text/css">

    <!-- external javascripts -->
    <script src="{{ asset('templates/pgeconstruction/js/jquery.js') }}"></script>
    <script src="{{ asset('templates/pgeconstruction/js/popper.min.js') }}"></script>
    <script src="{{ asset('templates/pgeconstruction/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templates/pgeconstruction/js/javascript-plugins-bundle.js') }}"></script>
    <script src="{{ asset('templates/pgeconstruction/js/menuzord/js/menuzord.js') }}"></script>

    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/pgeconstruction/js/revolution-slider/css/rs6.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/pgeconstruction/js/revolution-slider/extra-rev-slider1.css') }}">
    <!-- REVOLUTION LAYERS STYLES -->
    <!-- REVOLUTION JS FILES -->
    <script src="{{ asset('templates/pgeconstruction/js/revolution-slider/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('templates/pgeconstruction/js/revolution-slider/js/rs6.min.js') }}"></script>
    <script src="{{ asset('templates/pgeconstruction/js/revolution-slider/extra-rev-slider2.js') }}"></script>

    @if($article->template == 'contacts-off')
		<link rel="stylesheet" type="text/css" href="{{ asset('templates/pgeconstruction/dist/css/contacts.css') }}?{{ $VERSION }}">
	@endif

    @if($article->template == 'main-off')
		<link rel="stylesheet" href="{{ asset('templates/pgeconstruction/dist/css/libs/animate.min.css') }}?{{ $VERSION }}">
		<script src="{{ asset('templates/pgeconstruction/dist/js/libs/wow/wow.min.js') }}"></script>
		<script>new WOW().init();</script>
	@endif

</head>
<body class="tm-container-1300px has-side-panel side-panel-right switchable-logo lang_{{ $LANG }}">

    {!! $SETTING['code_body']['val'] !!}

    <!-- preloader -->
    <div id="preloader">
        <div id="spinner">
            <div class="preloader-dot-loading">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
            </div>
        </div>
        <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
    </div>

    <!-- Side-panel-container -->
    @include('templates.components.side-panel-container')

    <!-- Wrapper -->
    <div id="wrapper" class="clearfix">

        <!-- Header -->
        @include('templates.components.header')

        <!-- Content -->
        @yield('content')

        <!-- Footer -->
        @include('templates.components.footer')

    </div>
    <!-- end wrapper -->

    <!-- Footer Scripts -->
    <!-- JS | Custom script for all pages -->
    <script src="{{ asset('templates/pgeconstruction/js/custom.js') }}"></script>


  </body>
</html>
