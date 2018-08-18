@extends('layouts.admin_dash')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css" media="print">
@endpush



@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <a href="{{route('page2')}}">Page 2</a>
        </li>
    </ol>
    <div class="row">
        <div class="col-12">
            <h1>Main Dash</h1>
            <div id='calendar2'></div>
        </div>
    </div>
@endsection
@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="{{ asset('js/admin/calendar.js') }}"></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar2').fullCalendar({
                // put your options and callbacks here
                events : [
                        @foreach($tasks as $task)
                    {
                        title : '{{ $task->title }}',
                        start : '{{ date('Y-m-d', strtotime($task->create_date)) }}',
                        end: '{{ date('Y-m-d', strtotime($task->due_date)) }}',
                        url : "{{route('ticket_view', ['id' => $task->id])}}"
                    },
                    @endforeach
                ]
            })
        });
    </script>
@endpush