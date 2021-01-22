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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Employee user role
        Gate::define('isEmployee', function($user) {
            return $user->userable_type === 'App\Models\Employee';
        });

        // Tenant user role
        Gate::define('isTenant', function($user) {
            return $user->userable_type === 'App\Models\Tenant';
        });

        // Management employee user role
        Gate::define('isManagement', function($user) {
            return $user->userable->role === 'Management';
        });

        // Management or Administrative employee user role
        Gate::define('isAdministrative', function($user) {
            return $user->userable->role === 'Management' || $user->userable->role === 'Administrative';
        });

        // Maintenance employee user role
        Gate::define('isMaintenance', function($user) {
            return $user->userable->role === 'Maintenance';
        });
    }
}
