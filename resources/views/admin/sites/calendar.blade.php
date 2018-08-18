@extends('layouts.admin_dash')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css" media="print">
@endpush

@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="{{ asset('js/admin/calendar.js') }}"></script>
    <script>
        $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar2').fullCalendar({
                // put your options and callbacks here
                events : [
                        @foreach($siteInfo->projects as $s)
                    {
                        title : '{{ $s->title }}',
                        start : '{{ date('Y-m-d', strtotime($s->create_date)) }}',
                        end: '{{ date('Y-m-d', strtotime($s->due_date)) }}',
                        url : "{{route('project_view', ['id' => $s->id])}}"
                    },
                    @endforeach
                ]
            })
        });
    </script>
@endpush

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('site_all')}}">Sites</a></li>
        <li class="breadcrumb-item active">{{$siteInfo->title}}</li>
    </ol>
    <div class="row">

        <div class="col-9">
            <h2>#{{$siteInfo->id}} {{$siteInfo->title}}</h2>
            <div id='calendar2'></div>
        </div>

        @include('admin.sites.side')

    </div>
@endsection
