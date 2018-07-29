@extends('layouts.admin_dash')
@push('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('js/datepickers.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['gantt']});
        google.charts.setOnLoadCallback(drawChart);

        function daysToMilliseconds(days) {
            return days * 24 * 60 * 60 * 1000;
        }

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task ID');
            data.addColumn('string', 'Task Name');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');

            data.addRows([
                ['Research', 'Find sources',
                    new Date(2015, 0, 1), new Date(2015, 0, 5), null, 100, null],
                ['Write', 'Write paper',
                    null, new Date(2015, 0, 9), daysToMilliseconds(3), 25, 'Research,Outline'],
                ['Cite', 'Create bibliography',
                    null, new Date(2015, 0, 7), daysToMilliseconds(1), 20, 'Research'],
                ['Complete', 'Hand in paper',
                    null, new Date(2015, 0, 10), daysToMilliseconds(1), 0, 'Cite,Write'],
                ['Outline', 'Outline paper',
                    null, new Date(2015, 0, 6), daysToMilliseconds(1), 100, 'Research']
            ]);

            var options = {
                height: 275
            };

            var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
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
                    <form id="cycleForm" method="POST" action="{{route('saveNewCycle')}}">
                        @csrf
                        {{ method_field('post') }}
                        <input type="hidden" name="created_by" value="{{$cycleInfo->created_by}}">
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
                                       value="{{old('git_tag')}}" id="git_tag">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button id="cycleSaveBtn" type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>


    </div>
@endsection
