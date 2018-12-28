@extends('layouts.admin_dash')

@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('project_all')}}">All</a></li>
    </ol>
    <div class="row">

        <div class="col-9">
            <h2>All Projects</h2>

            <table class="table table-bordered">
                <tr>
                    <th>Number</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Due</th>
                </tr>

                @foreach($projects as $project)
                    <tr>
                        <td>#{{ $project->id }}</td>
                        <td><a href="{{route('project_view', ['id' => $project->id])}}"> {{ $project->title }}</a></td>
                        <td>{{ $project->create_date }}</td>
                        <td>{{ $project->due_date }}</td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>


@endsection