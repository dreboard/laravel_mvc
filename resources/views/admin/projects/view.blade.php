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
        <li class="breadcrumb-item"><a href="{{route("site_view", ['id' => $project->site->id])}}"> {{$project->site->title}}</a></li>
        <li class="breadcrumb-item active">{{$project->title}}</li>
    </ol>

    <div id="invoice">

        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <main>
                    <div class="row contacts">
                        <project-view
                            title="{{$project->title}}"
                            description="{{$project->description}}"
                            project_id="{{$project->id}}"
                            project_edit_url="{{route('project_edit')}}"
                            project_get_url="{{route('project_get', ['id' => $project->id])}}"
                        >
                        </project-view>

                    </div>

                    <h3>Tickets</h3>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTicketForm">
                        New Ticket
                    </button>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="text-left">Name</th>
                            <th class="text-right">Created</th>
                            <th class="text-right">Due</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($project->tickets as $ticket)
                            <tr>
                                <td class="w-75 text-left"><a href="{{route('ticket_view', ['id' => $ticket->id])}}"> {{ $ticket->title }}</a></td>
                                <td class="unit">{{ Carbon\Carbon::parse($ticket->create_date)->format('M d Y H:i:s a') }}</td>
                                <td class="qty">{{ Carbon\Carbon::parse($ticket->due_date)->format('M d Y H:i:s a') }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-left">Info Name</th>
                            <th class="text-right">Created</th>
                            <th class="text-right">Due</th>
                        </tr>
                        </tfoot>
                    </table>

                </main>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="newTicketForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create A New Ticket</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection