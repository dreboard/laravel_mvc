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
        <p>Loremenim.</p>
        <h3 class="my-3">Project Details</h3>
        <p>Loremenim.</p>
        <ul>
            <li>Loresum</li>
            <li>Doloet</li>
            <li>Consectetur</li>
            <li>Adipisclit</li>
        </ul>
    </div>
    @include('partials.links')
</div>
<!-- /.row -->
@endsection