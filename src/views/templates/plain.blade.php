<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ isset($title) ? $title : trans('pageblok::app.appname') }}</title>

        <link rel="stylesheet" href="{{ asset('packages/adis-me/pageblok/css/bootstrap.min.css'); }}">
        <link rel="stylesheet" href="{{ asset('packages/adis-me/pageblok/css/style.css'); }}">
        @yield('styles')


        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="{{ asset('packages/adis-me/pageblok/img/ico/favicon.ico'); }}">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-57x57.png'); }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-114x114.png'); }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-72x72.png'); }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-144x144.png'); }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-60x60.png'); }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-120x120.png'); }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-76x76.png'); }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-152x152.png'); }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('packages/adis-me/pageblok/img/ico/apple-touch-icon-180x180.png'); }}">
        <link rel="icon" type="image/png" href="{{ asset('packages/adis-me/pageblok/img/ico/favicon-192x192.png'); }}" sizes="192x192">
        <link rel="icon" type="image/png" href="{{ asset('packages/adis-me/pageblok/img/ico/favicon-160x160.png'); }}" sizes="160x160">
        <link rel="icon" type="image/png" href="{{ asset('packages/adis-me/pageblok/img/ico/favicon-96x96.png'); }}" sizes="96x96">
        <link rel="icon" type="image/png" href="{{ asset('packages/adis-me/pageblok/img/ico/favicon-16x16.png'); }}" sizes="16x16">
        <link rel="icon" type="image/png" href="{{ asset('packages/adis-me/pageblok/img/ico/favicon-32x32.png'); }}" sizes="32x32">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="msapplication-TileImage" content="{{ asset('packages/adis-me/pageblok/img/ico/mstile-144x144.png'); }}">
        <meta name="msapplication-config" content="{{ asset('packages/adis-me/pageblok/img/ico/browserconfig.xml'); }}">

    </head>

    <body>
        <!-- Notifications have a top margin of -21px; -->
        <div style="margin-top: 21px;">
            @include("pageblok::panels.notifications")
        </div>

        @yield('content')

        <script src="{{ asset('packages/adis-me/pageblok/js/pageblok.min.js'); }}"></script>
        @yield('scripts')
    </body>
</html>
