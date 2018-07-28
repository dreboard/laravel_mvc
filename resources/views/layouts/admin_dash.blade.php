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

    <link href={{asset("vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
    <link href={{asset("vendor/font-awesome/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href={{asset("css/sb-admin.css")}} rel="stylesheet">

    @stack('css')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-72571847-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-72571847-2');
    </script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<!-- Navigation-->
@include('partials.side_nav')

<div class="content-wrapper">
    <div class="container-fluid">
        @yield('content')
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
@include('partials.admin_footer')
