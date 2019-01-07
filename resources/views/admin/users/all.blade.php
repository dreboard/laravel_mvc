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
        <li class="breadcrumb-item active">Sites</li>
    </ol>
    <div class="row">
        <div class="col-9">
            <h2>All Users ({{ $count }})</h2>
            <p><a href="{{route("site_new")}}">Create New</a></p>


            <table class="table table-bordered">
                <tr>
                    <th class="w-25">Number</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>created_by</th>
                </tr>

                @foreach($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td><a href="{{route("site_view", ['id' => $user->id])}}"> {{ $user->email }}</a></td>
                        <td><a href="{{ $user->url }}"> {{ $user->url }}</a></td>
                        <td><a href="{{route("user_clone", ['id' => $user->id])}}">Clone</a></td>
                    </tr>
                @endforeach

            </table>


        </div>
    </div>
@endsection
