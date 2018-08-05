@extends('layouts.front')

@section('content')
    <!-- Portfolio Item Heading -->
    <h1 class="my-4">
        Controllers
    </h1>

    <!-- Portfolio Item Row -->
    <div class="row">
        <div class="col-md-9">
            <h3 class="my-3">CycleController
                <small> <a href="https://github.com/dreboard/laravel_mvc/blob/master/app/Http/Controllers/CycleController.php"><i class="fa fa-github"></i></a></small>
            </h3>
            <p>This controller oversees the CRUD operations for Cycles.</p>
            <h3 class="my-3">Features Used</h3>
            <ul>
                <li>App\Services\CycleService::class to process business logic</li>
                <li>Events Created (App\Events\NewCycleEvent)
                    <ul>
                        <li>LogNewCycleListener::class - log new creation</li>
                        <li>MailNewCycleListener::class - mail new creation (CycleCreatedMailable::class)</li>
                    </ul>
                </li>
                <li>Cycle Form Request & Manually Created Validators (CycleSaveRequest)</li>
                <li>Helper classes to validate and format dates</li>
                <li>Custom Monolog channel - Log::channel('cycle')</li>
                <li>Route Grouping</li>
                <li>Route unit testing</li>
            </ul>
        </div>
        @include('partials.links')
    </div>
    <!-- /.row -->
@endsection