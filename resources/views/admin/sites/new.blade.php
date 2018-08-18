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
        <li class="breadcrumb-item">
            <a href="{{route('site_all')}}">Sites</a>
        </li>
        <li class="breadcrumb-item active">New Site</li>
    </ol>
    <div class="row">
        <div class="col-9">
            <h2>Create A New Site</h2>
            <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="cycleForm" method="post" action="{{route('cycle_save')}}">
                @csrf
                {{ method_field('post') }}
                <input type="hidden" name="created_by" value="{{$created_by}}">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" placeholder="title" value="{{old('title')}}" id="cycle_title">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Dates</label>
                    <div class="col-sm-10">
                        <div class="form-group row">
                            <div class="col">
                                <input type="text" class="form-control datepicker" placeholder="start date" name="start_date" value="{{old('start_date')}}" id="cycle_start_date">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control datepicker" placeholder="end date" name="end_date" value="{{old('end_date')}}" id="cycle_end_date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="git_tag" class="col-sm-2 col-form-label">Git Tag</label>
                    <div class="col-sm-10">
                        <input name="git_tag" type="text" class="form-control" placeholder="v0.0.0" value="{{old('git_tag')}}" id="git_tag">
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-10">
                        <button id="cycleSaveBtn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection
