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
    <link href={{asset("css/sb-admin.css")}} rel="stylesheet">
</head>

<body>

<!-- Navigation -->
@include('partials.main_nav')

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">A Bootstrap 4 Starter Template</h1>
            <p class="lead">Complete with pre-defined file paths and responsive navigation!</p>
            <ul class="list-unstyled">
                <li>Bootstrap 4.1.3</li>
                <li>jQuery 3.3.1</li>
            </ul>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>