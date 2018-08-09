@extends('layouts.admin_dash')

@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">
            <a href="{{route('page2')}}">Page 2</a>
        </li>
    </ol>
    <div class="row">
        <div class="col-12">
            <h1>Projects</h1>
            <p>The Home page.</p>
        </div>
    </div>
@endsection