@extends('layouts.admin_dash')
@push('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
@endpush

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{asset('js/datepickers.js')}}"></script>
    <script>
        $( document ).ready(function() {
            var newTicketUrl = '{{route('project_save')}}';

            $('#newProjectFormBtn').click(function (e) {
                e.preventDefault();
                $(".print-error-msg").hide().find("ul").html('');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route('project_save')}}',

                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        title: $('input[name=title]').val(),
                        description: $('#projectDesc').val(),
                        create_date: $('input[name=create_date]').val(),
                        due_date: $('input[name=due_date]').val(),
                        site_id: $('input[name=site_id]').val()
                    },

                    type: "POST",
                    dataType: "json",
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8'
                })
                    .done(function (result) {
                        console.log(result.errors);
                        if (result.errors) {
                            console.log(result.errors);
                            $(".print-error-msg").show().find("ul").html('').css('display', 'block');
                            $.each(result.errors, function (key, value) {
                                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                            });
                        }else {
                            window.location = result.url;
                        }
                    })

                    .fail(function (xhr, status, errorThrown) {
                        console.log(xhr, status, errorThrown);
                    });
            });

            $('#newProjectFormBtn2').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('project_save')}}',
                    method: 'post',
                    data: {
                        title: $('#projectTitle').val(),
                        description: $('#projectDesc').val(),
                        create_date: $('#projectStartDate').val(),
                        due_date: $('#projectDueDate').val(),
                    },
                    success: function(result){
                        console.log(result);
                        if(result.errors)
                        {


                            $('.alert-danger').html('');

                            $.each(result.errors, function(key, value){
                                $('.alert-danger').show();
                                $('.alert-danger').append('<li>'+value+'</li>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').hide();
                            $('#open').hide();
                            $('#myModal').modal('hide');
                        }
                    }});
            });
        });
    </script>
@endpush
@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}">Home</a>
        </li>
        <li class="breadcrumb-item active">{{$site->title}}</li>
    </ol>

    <div id="invoice">

        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">Site:</div>
                            <h2 class="to"><a href="{{route("site_view", ['id' => $site->id])}}"> {{$site->title}}</a></h2>
                            <div class="address">{{$site->description}}</div>
                        </div>
                        <div class="col invoice-details">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                New Project
                            </button>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="text-left">Info Name</th>
                            <th class="text-right">Created</th>
                            <th class="text-right">Due</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($site->projects as $project)
                            <tr>
                                <td class="w-75 text-left"><h3><a href="{{route('project_view', ['id' => $project->id])}}"> {{ $project->title }}</a></h3>{{$project->description}}</td>
                                <td class="unit">{{ Carbon\Carbon::parse($project->create_date)->format('M d Y H:i:s a') }}</td>
                                <td class="qty">{{ Carbon\Carbon::parse($project->due_date)->format('M d Y H:i:s a') }}</td>
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create A New Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="alert alert-danger print-error-msg" style="display:none">

                                <ul></ul>

                            </div>

                            <form id="newProjectForm" method="POST" action="{{route('project_save')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="projectTitle" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input name="title" type="text" class="form-control" placeholder="title" value="{{old('title')}}" id="projectTitle">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="projectDesc" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" rows="3" id="projectDesc"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="projectStartDate" class="col-sm-2 col-form-label">Dates</label>
                                    <div class="col-sm-10">
                                        <div class="form-group row">
                                            <div class="col">
                                                <input type="text" class="form-control datepicker" placeholder="start date" name="create_date" value="{{old('create_date')}}" id="projectStartDate">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control datepicker" placeholder="end date" name="due_date" value="{{old('due_date')}}" id="projectDueDate">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="site_id" name="site_id" value="{{$site->id}}">
                                @csrf
                                <button type="submit" id="newProjectFormBtn" class="btn btn-primary">Create</button>
                            </form>
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
