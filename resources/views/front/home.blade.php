@extends('layouts.front')

@section('content')
<!-- Portfolio Item Heading -->
<h1 class="my-4">Project Home
    <small>Welcome to {{getenv('APP_ENV')}}</small>
</h1>

<!-- Portfolio Item Row -->
<div class="row">
    <div class="col-md-9">
        <h3 class="my-3">Laravel MVC Portfolio</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
        <h3 class="my-3">Project Details</h3>
        <ul>
            <li>Lorem Ipsum</li>
            <li>Dolor Sit Amet</li>
            <li>Consectetur</li>
            <li>Adipiscing Elit</li>
        </ul>
    </div>
    @include('partials.links')
</div>
<!-- /.row -->
@endsection