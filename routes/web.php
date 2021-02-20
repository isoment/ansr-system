<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Auth::routes();

// Lease Application
Route::get('/lease-application/{propertyListing}', [\App\Http\Controllers\GuestFeatureController::class, 'leaseApplication'])
    ->name('lease-application');

// Lease Application Confirmation
Route::get('/lease-application-confirmation', [\App\Http\Controllers\GuestFeatureController::class, 'leaseApplicationConfirmation'])
    ->name('lease-application-confirmation');

Route::get('/property-listings', [\App\Http\Controllers\GuestFeatureController::class, 'propertyListingsIndex'])
    ->name('property-listings');

Route::get('/property-listings/{propertyListing}', [\App\Http\Controllers\GuestFeatureController::class, 'propertyListingShow'])
    ->name('property-listing-show');

// Tenant Routes
Route::middleware('can:isTenant')->group(function() {

    // Dashboard
    Route::get('/tenant/db', [\App\Http\Controllers\Tenant\TenantDashboardController::class, 'index'])
        ->name('tenant.dashboard');

    // Key request
    Route::get('tenant/replace-key', [\App\Http\Controllers\Tenant\ServiceRequestController::class, 'keyReplacement'])
        ->name('replace.key');
    // Store key request
    Route::post('tenant/replace-key', [\App\Http\Controllers\Tenant\ServiceRequestController::class, 'keyReplacementStore'])
        ->name('replace.key.store');
    // Service request
    Route::get('tenant/service-request', [\App\Http\Controllers\Tenant\ServiceRequestController::class, 'createServiceRequest'])
        ->name('tenant.service-request');
    // Service request store
    Route::post('tenant/service-request', [\App\Http\Controllers\Tenant\ServiceRequestController::class, 'serviceRequestStore'])
        ->name('tenant.service-request.store');
    // Service request index
    Route::get('tenant/my-requests', [\App\Http\Controllers\Tenant\ServiceRequestController::class, 'index'])
        ->name('tenant.request-index');

});

// Employee Routes
Route::middleware('can:isEmployee')->group(function() {

    // Dashboard
    Route::get('/employee/db', [\App\Http\Controllers\Employee\EmployeeDashboardController::class, 'index'])
        ->name('employee.dashboard');

    // Service Requests
    Route::get('/employee/service-request', [\App\Http\Controllers\Employee\ServiceRequestController::class, 'index'])
        ->name('employee.service-request-index');
    // Request Management
    Route::get('/employee/service-request/{request}/manage', [\App\Http\Controllers\Employee\ServiceRequestController::class, 'manageRequest'])
        ->name('employee.manage-request');

    // Manage Work Orders
    Route::get('/employee/work-order/{workOrder}/manage', [\App\Http\Controllers\Employee\WorkOrderController::class, 'manageWorkOrder'])
        ->name('employee.manage-workorder');
    // Manage Work Details
    Route::get('/employee/work-detail/{workDetail}/manage', [\App\Http\Controllers\Employee\WorkOrderController::class, 'manageDetails'])
        ->name('employee.manage-details');

    // Assigned work order
    Route::get('/employee/my-work-orders', [\App\Http\Controllers\Employee\WorkOrderController::class, 'assignedWorkOrderIndex'])
        ->name('employee.my-work-orders');

    // Management employees only
    Route::middleware('can:isManagement')->group(function() {

        // Regions
        Route::get('/employee/regions', [\App\Http\Controllers\Employee\PropertyController::class, 'region'])
            ->name('employee.region');

        // Requests Category
        Route::get('/employee/request-category', [\App\Http\Controllers\Employee\ServiceRequestController::class, 'requestCategory'])
            ->name('employee.request-category');

        // Tenant Admin
        Route::get('/employee/user-admin/tenant', [\App\Http\Controllers\Employee\UserAdminController::class, 'tenantIndex'])
        ->name('employee.tenant-index');
        // Tenant Edit
        Route::get('/employee/user-admin/tenant/{tenant}/edit', [\App\Http\Controllers\Employee\UserAdminController::class, 'tenantEdit'])
            ->name('employee.tenant-edit');
        // Employee Admin
        Route::get('/employee/user-admin/employee', [\App\Http\Controllers\Employee\UserAdminController::class, 'employeeIndex'])
            ->name('employee.employee-index');
        // Employee Create
        Route::get('/employee/user-admin/employee-create', [\App\Http\Controllers\Employee\UserAdminController::class, 'employeeCreate'])
            ->name('employee.employee-create');
        // Employee Edit
        Route::get('/employee/user-admin/employee/{employee}/edit', [\App\Http\Controllers\Employee\UserAdminController::class, 'employeeEdit'])
            ->name('employee.employee-edit');

    });

    // Management and Administrative Employees
    Route::middleware('can:isAdministrativeOrManagement')->group(function() {

        // Properties
        Route::get('/employee/properties', [\App\Http\Controllers\Employee\PropertyController::class, 'index'])
            ->name('employee.properties-index');
        // Create Properties
        Route::get('/employee/properties/create', [\App\Http\Controllers\Employee\PropertyController::class, 'create'])
            ->name('employee.properties-create');
        // Edit Properties
        Route::get('/employee/properties/{property}/edit', [\App\Http\Controllers\Employee\PropertyController::class, 'edit'])
            ->name('employee.properties-edit');
        // Lease Applications Index
        Route::get('/employee/lease-applications', [\App\Http\Controllers\Employee\LeaseController::class, 'leaseApplicationIndex'])
            ->name('employee.lease-application-index');
        // Lease Application Management
        Route::get('/employee/lease-application/{leaseApplication}/manage', [\App\Http\Controllers\Employee\LeaseController::class, 'leaseApplicationManange'])
            ->name('employee.lease-application-manage');

    });

});
