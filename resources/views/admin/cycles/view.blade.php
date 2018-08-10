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
        <li class="breadcrumb-item active">{{$cycleInfo->title}}</li>
    </ol>
    <div class="row">

        <div class="col-9">
            <h2>#{{$cycleInfo->id}} {{$cycleInfo->title}}</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                       aria-controls="contact" aria-selected="false">Projects</a>
                </li>
            </ul>
            <div class="tab-content cycleTabContent" id="myTabContent">
                <div class="tab-pane fade show active cycleTabPane" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div id="chart_div"></div>
                </div>
                <div class="tab-pane fade cycleTabPane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form id="cycleForm" method="POST" action="{{route('updateCycle')}}">
                        @csrf
                        {{ method_field('post') }}
                        <input type="hidden" name="created_by" value="{{$cycleInfo->created_by}}">
                        <input type="hidden" name="id" value="{{$cycleInfo->id}}">
                        <div class="form-group row">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input name="title" type="text" class="form-control" placeholder="title"
                                       value="{{$cycleInfo->title}}" id="cycle_title">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="start_date" class="col-sm-2 col-form-label">Dates</label>
                            <div class="col-sm-10">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control datepicker" placeholder="start date"
                                               name="start_date" value="{{$cycleInfo->start_date}}"
                                               id="cycle_start_date">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control datepicker" placeholder="end date"
                                               name="end_date" value="{{$cycleInfo->end_date}}" id="cycle_end_date">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="git_tag" class="col-sm-2 col-form-label">Git Tag</label>
                            <div class="col-sm-10">
                                <input name="git_tag" type="text" class="form-control" placeholder="v0.0.0"
                                       value="{{$cycleInfo->git_tag}}" id="git_tag">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button id="cycleSaveBtn" type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                    <table class="table table-bordered">
                        <tr>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Due</th>
                        </tr>

                        @foreach($cycleInfo->projects as $project)
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
        </div>


    </div>
@endsection
