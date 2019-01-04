<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Ticket' => 'App\Policies\TicketPolicy',
        'App\Site' => 'App\Policies\SitePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-task', function ($user, $task) {
            return $user->id == $task->user_id;
        });

        Gate::define('edit-ticket', 'App\Policies\TicketPolicy@edit');

        Gate::define('new-task', function ($user, $ticket) {
            return $user->id == $ticket->user_id;
        });

        Gate::define('new-note', function($ticket){
            return $ticket->open_edit == 1;
        });

    }
}
