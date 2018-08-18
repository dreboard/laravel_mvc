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
        <li class="breadcrumb-item active">New Ticket</li>
    </ol>
    <div class="row">
        <div class="col-9">
            <h2>Create A New Ticket</h2>
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

            <form id="newTicketForm" method="post" action="{{route('ticket_save')}}">
                @csrf
                {{ method_field('post') }}
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" placeholder="title" value="{{old('title')}}" id="cycle_title">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Dates</label>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <div class="col">
                                <input type="text" class="form-control datepicker" placeholder="due date" name="due_date" value="{{old('due_date')}}" id="ticket_due_date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-3">
                        <select id="priority" name="priority" class="form-control">
                            <option value="low">Low</option>
                            <option value="medium">medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">For Project:</label>
                    <div class="col-sm-10">
                        @if($project)
                            <input name="project_id" type="text" class="form-control" placeholder="title" value="{{$project->id}}" id="project_id" disabled>
                        @else
                            <select class="form-control" name="project_id">
                                @foreach($projects as $projectList)
                                    <option value="{{$projectList->id}}">{{$projectList->title}}</option>
                                @endforeach
                            </select>
                        @endif

                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10">
                        <button id="newTicketFormBtn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection
