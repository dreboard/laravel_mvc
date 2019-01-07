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
        <li class="breadcrumb-item active">{{$user->title}}</li>
    </ol>

    <div id="invoice">

        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">User:</div>
                            <h2 class="to"><a href="{{route("site_view", ['id' => $user->id])}}"> {{$user->title}}</a></h2>
                            <div class="address">{{$user->description}}</div>
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

                        @foreach($user->sites as $site)
                            <tr>
                                <td class="w-75 text-left"><h3><a href="{{route('site_view', ['id' => $site->id])}}"> {{ $site->title }}</a></h3>{{$site->description}}</td>
                                <td class="unit"></td>
                                <td class="qty"></td>
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
                            <form id="newProjectForm" method="POST" action="{{route('project_save')}}">
                                @csrf
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
                                <input type="hidden" name="site_id" value="{{$user->id}}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Create</button>
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
