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
        <li class="breadcrumb-item active">New Cycle</li>
    </ol>
    <div class="row">
        <div class="col-9">
            <h2>Current Cycles</h2>
            <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>


            <table class="table table-bordered">
                <tr>
                    <th>Number</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Due</th>
                </tr>

                @foreach($allCycles as $ticket)
                    <tr>
                        <td>#{{ $ticket->id }}</td>
                        <td><a href="{{route("cycle_view", ['id' => $ticket->id])}}"> {{ $ticket->title }}</a></td>
                        <td>{{ $ticket->start_date }}</td>
                        <td>{{ $ticket->end_date }}</td>
                    </tr>
                @endforeach

            </table>


        </div>
    </div>
@endsection
