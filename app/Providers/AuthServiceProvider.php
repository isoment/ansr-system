<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\ServiceRequest;
use App\Models\WorkDetails;
use App\Models\WorkOrder;
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


        /*************
         *  GENERAL  *
         *************/

        // Employee user role
        Gate::define('isEmployee', function($user) {
            return $user->userable_type === 'App\Models\Employee';
        });

        // Tenant user role
        Gate::define('isTenant', function($user) {
            return $user->userable_type === 'App\Models\Tenant';
        });


        /***********************
         *  EMPLOYEE SPECIFIC  *
         ***********************/

        // Maintenance employee user role check
        Gate::define('isMaintenance', function($user) {
            return $user->userable->role === 'Maintenance';
        });

        // Administrative employee user role check
        Gate::define('isAdministrative', function($user) {
            return $user->userable->role === 'Administrative';
        });

        // Management employee user role check
        Gate::define('isManagement', function($user) {
            return $user->userable->role === 'Management';
        });

        // Management or Administrative employee user role check
        Gate::define('isAdministrativeOrManagement', function($user) {
            return $user->userable->role === 'Management' || $user->userable->role === 'Administrative';
        });

        // User and property have same regions
        Gate::define('propertyAndUserHaveSameRegion', function($user, Property $property) {
            return $user->userable->region->region_name === $property->region->region_name;
        });

        // User and service request have same region
        Gate::define('requestAndUserHaveSameRegion', function($user, ServiceRequest $serviceRequest) {
            return $user->userable->region->region_name === $serviceRequest->lease->property->region->region_name;
        });

        // User and work order have the same region
        Gate::define('workOrderAndUserHaveSameRegion', function($user, WorkOrder $workOrder) {
            return $user->userable->region->region_name === $workOrder->serviceRequest->lease->property->region->region_name;
        });

        // User and work detail have the same region
        Gate::define('workDetailAndUserHaveSameRegion', function($user, WorkDetails $workDetail) {
            return $user->userable->region->region_name === $workDetail->workOrder->serviceRequest->lease->property->region->region_name;
        });
    }
}
