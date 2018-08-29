@extends('layouts.admin_dash')
@push('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('js/datepickers.js')}}"></script>
    <script>
        var ticket = {
            url: "{{ route('ticket_edit_status') }}",
            task_url: "{{ route('task_update') }}",
            token: "{!! csrf_token() !!}"
        };
    </script>
    <script src="{{ asset('js/admin/ticket_update.js?v=122') }}"></script>
@endpush

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('ticket_all')}}">All</a></li>
        <li class="breadcrumb-item active">{{$ticket->title}}</li>
    </ol>
    <div class="row">

        <div class="col-9">
            <h2>#{{$ticket->id}} {{$ticket->title}}</h2>
            <p>Project: <a
                        href="{{route('project_view', ['id' => $ticket->project->id])}}"> {{$ticket->project->title}}</a>
            </p>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <p class="edited"></p>
            @include('admin.tickets.edit_links')
            <form id="ticketEditForm" method="POST" action="{{route('updateCycle')}}">
                @csrf
                {{ method_field('post') }}
                <input type="hidden" name="created_by" value="{{$ticket->created_by}}">
                <input type="hidden" name="id" value="{{$ticket->id}}">
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control" placeholder="title"
                               value="{{$ticket->title}}" id="cycle_title">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="start_date" class="col-sm-2 col-form-label">Dates</label>
                    <div class="col-sm-10">
                        <div class="form-group row">
                            <div class="col">
                                <input type="text" class="form-control datepicker" placeholder="start date"
                                       name="start_date" value="{{$ticket->create_date}}"
                                       id="cycle_start_date">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control datepicker" placeholder="end date"
                                       name="end_date" value="{{$ticket->due_date}}" id="cycle_end_date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="git_tag" class="col-sm-2 col-form-label">Git Tag</label>
                    <div class="col-sm-10">
                        <input name="git_tag" type="text" class="form-control" placeholder="v0.0.0"
                               value="{{$ticket->completed}}" id="git_tag">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10">
                        <button id="ticketEditFormBtn" type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    </div>
@endsection