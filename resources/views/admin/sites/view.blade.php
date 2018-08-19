@extends('layouts.admin_dash')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('site_all')}}">All</a></li>
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
