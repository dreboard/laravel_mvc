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
        <li class="breadcrumb-item"><a href="{{route('site_all')}}">All</a></li>
        <li class="breadcrumb-item active">{{$siteInfo->title}}</li>
    </ol>
    <div class="row">

        <div class="col-9">
            <h2>#{{$siteInfo->id}} {{$siteInfo->title}}</h2>
            @if(!empty($errors))
                @if($errors->any())
                    <ul class="alert alert-danger" style="list-style-type: none">
                        @foreach($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                @endif
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>Number</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Due</th>
                </tr>

                @foreach($siteInfo->projects as $project)
                    <tr>
                        <td>#{{ $project->id }}</td>
                        <td><a href="{{route('project_view', ['id' => $project->id])}}"> {{ $project->title }}</a></td>
                        <td>{{ $project->create_date }}</td>
                        <td>{{ $project->due_date }}</td>
                    </tr>
                @endforeach

            </table>
        </div>

        @include('admin.sites.side')


    </div>
@endsection
