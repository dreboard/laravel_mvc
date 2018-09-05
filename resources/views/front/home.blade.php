@extends('layouts.front')

@section('content')


<!-- Portfolio Item Row -->
<div class="row">
    <div class="col-md-9">
        <!-- Portfolio Item Heading -->
        <h1 class="my-4">Project Home
            <small>Welcome to {{getenv('APP_ENV')}}</small>
        </h1>
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

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Section</th>
                <th scope="col">Demonstrates</th>
                <th scope="col">Code</th>
                <th scope="col">Test</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Login</th>
                <td>Events/logging</td>
                <td><a href="https://github.com/dreboard/laravel_mvc/blob/master/app/Listeners/LogNewSiteListner.php">Link</a> </td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>
    @include('partials.links')
</div>
<!-- /.row -->
@endsection