@extends('layouts.admin_dash')
@push('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('js/datepickers.js')}}"></script>

@endpush

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('allCycle')}}">All</a></li>
        <li class="breadcrumb-item active">{{$siteInfo->title}}</li>
    </ol>
    <div class="row">

        <div class="col-9">
            <h2>#{{$siteInfo->id}} {{$siteInfo->title}}</h2>
            {{$siteInfo->title}}

            <p>{{$siteInfo->description}}</p>
            <p>{{$siteInfo->git_url}}</p>

        </div>

        @include('admin.sites.side')

    </div>
@endsection
