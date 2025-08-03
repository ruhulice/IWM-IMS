<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>IWM-IMS @yield('title')</title>

        <meta name="description" content="SMART BHUMI NAKSHA">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Digital Mouza Map Management System(DMMMS)">
        <meta property="og:site_name" content="Digital Mouza Map Management System(DMMMS)">
        <meta property="og:description" content="Digital Mouza Map Management System(DMMMS)">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://www.iwmbd.org/">
        <meta property="og:image" content="https://www.iwmbd.org/images/header/Tungipara_visit_001.jpg">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        {{-- <link rel="icon" type="image/png" href="{{ asset('assets/media/favicons/logo.png') }}"> --}}
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">

        @yield('css_before')

        <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.css') }}">

		@yield('css_after')

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body>
        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->

				@yield('content')

                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="{{ asset('assets/js/codebase.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ asset('assets/js/laravel.app.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.js') }}"></script>

        @yield('js_after')

    </body>
</html>
