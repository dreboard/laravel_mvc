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
            url_completed: "{{ route('ticket_edit_complete') }}",
            url_status: "{{ route('ticket_edit_status') }}",
            token: "{!! csrf_token() !!}"
        };
    </script>
    <script src="{{ asset('js/admin/ticket_update.js?v=echo') }}"></script>
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

        <div class="col-12">
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
                       aria-controls="contact" aria-selected="false">Files</a>
                </li>
            </ul>


                    <div class="row">
                        <div class="col-sm-12">
                            <p>{{$ticket->description}}</p>
                        </div>
                        <div class="col-sm-6">
                            <form id="ticketStatusForm" method="POST" action="{{route('updateCycle')}}">
                                @csrf
                                {{ method_field('post') }}
                                <input type="hidden" id="created_by" name="created_by" value="{{$ticket->created_by}}">
                                <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-4">
                                        <select id="status" name="status" class="form-control">
                                            <option value="new" @if($ticket->status == 'new') selected @endif>New</option>
                                            <option value="working" @if($ticket->status == 'working') selected @endif>Working
                                            </option>
                                            <option value="complete" @if($ticket->status == 'complete') selected @endif>
                                                Complete
                                            </option>
                                            <option value="closed" @if($ticket->status == 'closed') selected @endif>Closed
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <form id="ticketStatusForm" method="POST" action="{{route('updateCycle')}}">
                                @csrf
                                {{ method_field('post') }}
                                <input type="hidden" id="created_by" name="created_by" value="{{$ticket->created_by}}">
                                <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Completed</label>
                                    <div class="col-sm-4">
                                        <select id="completed" name="completed" class="form-control">
                                            {{ $i = 0 }}
                                            @php
                                                for ($i = 0; $i <= 100; $i=$i+10) {
                                                    echo '<option value="'.$i.'" '; if($i == $ticket->completed){echo 'selected';} echo '>'.$i.'%</option>';
                                                }
                                            @endphp
                                        </select>

                                    </div>
                                    <div class="col-sm-4 progress" style="height: 40px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{$ticket->completed}}%;" aria-valuenow="{{$ticket->completed}}" aria-valuemin="0" aria-valuemax="100">
                                            <span id="progressbarText">{{$ticket->completed}}%</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>




                    <hr/>

                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Tasks</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>created_by</th>
                                </tr>

                                @foreach($ticket->tasks as $t)
                                    <tr>
                                        <td>#{{ $t->id }}</td>
                                        <td>{{ $t->title }}</td>
                                        <td>{{ $t->assigned }}</td>
                                        <td>
                                            <form class="form-inline" method="POST" action="{{route('task_update')}}">
                                                @csrf
                                                <div class="form-check mb-2 mr-sm-2">
                                                    <input
                                                            class="status_check"
                                                            type="checkbox"
                                                            id="taskStatus{{$t->id}}"
                                                            name="taskStatus"
                                                            data-task="{{$t->id}}"
                                                            value="{{ $t->complete }}"
                                                            @if($t->complete == 1) checked @endif
                                                    >
                                                    <label class="form-check-label" for="taskStatus">
                                                        Complete
                                                    </label>
                                                </div>
                                            </form>


                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>
                        <div class="col-sm-8">
                            <h4>Notes</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>created_by</th>
                                </tr>

                                @foreach($ticket->tasks as $t)
                                    <tr>
                                        <td>#{{ $t->id }}</td>
                                        <td>{{ $t->title }}</td>
                                        <td>{{ $t->assigned }}</td>
                                        <td>
                                            <form class="form-inline" method="POST" action="{{route('task_update')}}">
                                                @csrf
                                                <div class="form-check mb-2 mr-sm-2">
                                                    <input
                                                            class="status_check"
                                                            type="checkbox"
                                                            id="taskStatus{{$t->id}}"
                                                            name="taskStatus"
                                                            data-task="{{$t->id}}"
                                                            value="{{ $t->complete }}"
                                                            @if($t->complete == 1) checked @endif
                                                    >
                                                    <label class="form-check-label" for="taskStatus">
                                                        Complete
                                                    </label>
                                                </div>
                                            </form>


                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>

                    <h4>History</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>created_by</th>
                                </tr>

                                @foreach($ticket->tasks as $t)
                                    <tr>
                                        <td>#{{ $t->id }}</td>
                                        <td>{{ $t->title }}</td>
                                        <td>{{ $t->assigned }}</td>
                                        <td>
                                            <form class="form-inline" method="POST" action="{{route('task_update')}}">
                                                @csrf
                                                <div class="form-check mb-2 mr-sm-2">
                                                    <input
                                                            class="status_check"
                                                            type="checkbox"
                                                            id="taskStatus{{$t->id}}"
                                                            name="taskStatus"
                                                            data-task="{{$t->id}}"
                                                            value="{{ $t->complete }}"
                                                            @if($t->complete == 1) checked @endif
                                                    >
                                                    <label class="form-check-label" for="taskStatus">
                                                        Complete
                                                    </label>
                                                </div>
                                            </form>


                                        </td>

                                    </tr>
                                @endforeach

                            </table>

                        </div>
                    </div>




        </div>
    </div>


    </div>
@endsection