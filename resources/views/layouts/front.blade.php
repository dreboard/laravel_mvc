<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href={{asset("vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href={{asset("vendor/font-awesome/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href={{asset("css/front.css")}} rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-72571847-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        @if('local' === getenv('APP_ENV'))
        gtag('config', 'UA-72571847-2');
        @else
        gtag('config', 'UA-72571847-1');
        @endif

    </script>
</head>


<body>

<!-- Navigation -->
@include('partials.main_nav')

<!-- Page Content -->
<div class="container">

    @yield('content')

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website <?php echo date('Y'); echo exec('git rev-parse HEAD'); ?></p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
