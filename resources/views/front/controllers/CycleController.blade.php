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
            <p>This controller oversees the CRUD operations for Cycles. To keep the code down to a minimum in the class a CycleService::class was created in app/Services</p>
            <h3 class="my-3">Features Used</h3>
            <ul>
                <li>CycleService class to process business logic</li>
                <li>Custom mail/logging events, (LogNewCycleListener & MailNewCycleListener)</li>
                <li>Cycle Form Request & Manually Created Validators (CycleSaveRequest)</li>
                <li>Helper classes to validate and format dates</li>
                <li>Custom Monolog channel - Log::channel('cycle')</li>
            </ul>
        </div>
        @include('partials.links')
    </div>
    <!-- /.row -->
@endsection