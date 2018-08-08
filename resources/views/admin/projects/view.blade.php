@extends('layouts.admin_dash')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('allCycle')}}">All</a></li>
        <li class="breadcrumb-item active">{{$project->title}}</li>
    </ol>
    <div class="row">

        <div class="col-9">
            <h2>#{{$project->id}} {{$project->title}}</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="projectEditForm" method="POST" action="{{route('updateCycle')}}">
                @csrf
                {{ method_field('post') }}
                <input type="hidden" name="created_by" value="{{$project->created_by}}">
                <input type="hidden" name="id" value="{{$project->id}}">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" placeholder="title"
                               value="{{$project->title}}" id="cycle_title">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Dates</label>
                    <div class="col-sm-10">
                        <div class="form-group row">
                            <div class="col">
                                <input type="text" class="form-control datepicker" placeholder="start date"
                                       name="start_date" value="{{$project->due_date}}"
                                       id="cycle_start_date">
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10">
                        <button id="projectEditFormBtn" type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>

        </div>


    </div>
@endsection