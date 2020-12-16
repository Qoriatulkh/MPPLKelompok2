<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-cases', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('manage-areas', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('manage-paralegals', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('update-profile', function ($user) {
            return !$user->isAdmin();
        });
    }
}
