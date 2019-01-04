<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="dev-php">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    <!-- Custom styles for this template-->
    <link href={{asset("css/app.css")}} rel="stylesheet">

@stack('css')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-72571847-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        @if('local' === getenv('APP_ENV'))
        gtag('config', 'UA-72571847-2');
        @else
        gtag('config', 'UA-72571847-1');
        @endif

    </script>
</head>

<body class="fixed-nav sticky-footer bg-dark admin" id="page-top">

<!-- Navigation-->
@include('partials.side_nav')

<div class="content-wrapper">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="app" class="container-fluid">
        @yield('content')
    </div>

    @include('partials.admin_footer')
</div>
</body>
</html>