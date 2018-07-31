@extends('layouts.front')

@section('content')
    <!-- Portfolio Item Heading -->
    <h1 class="my-4">
        Controllers
    </h1>

    <!-- Portfolio Item Row -->
    <div class="row">
        <div class="col-md-9">
            <h3 class="my-3">Dev Trac Controllers
            <small> <a href="https://github.com/dreboard/laravel_mvc/tree/master/app/Http/Controllers"><i class="fa fa-github"></i></a></small>
            </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
            <h3 class="my-3">Project Details</h3>
            <ul>
                <li>{{$name}}</li>
                <li>FrontController</li>
                <li>HomeController</li>
                <li><a href="{{route('cycle_controller')}}">CycleController</a> </li>
            </ul>
        </div>
        @include('partials.links')
    </div>
    <!-- /.row -->
@endsection