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

    // Properties
    Route::get('/employee/properties', [\App\Http\Controllers\Employee\PropertyController::class, 'index'])
        ->name('employee.properties-index');
    // Create Properties
    Route::get('/employee/properties/create', [\App\Http\Controllers\Employee\PropertyController::class, 'create'])
        ->name('employee.properties-create');
    // Edit Properties
    Route::get('/employee/properties/{property}/edit', [\App\Http\Controllers\Employee\PropertyController::class, 'edit'])
        ->name('employee.properties-edit');
    // Regions
    Route::get('/employee/regions', [\App\Http\Controllers\Employee\PropertyController::class, 'region'])
        ->name('employee.region');

    // Service Requests
    Route::get('/employee/service-request', [\App\Http\Controllers\Employee\ServiceRequestController::class, 'index'])
        ->name('employee.service-request-index');
    // Requests Category
    Route::get('/employee/request-category', [\App\Http\Controllers\Employee\ServiceRequestController::class, 'requestCategory'])
        ->name('employee.request-category');
    // Request Management
    Route::get('/employee/service-request/{request}/manage', [\App\Http\Controllers\Employee\ServiceRequestController::class, 'manageRequest'])
        ->name('employee.manage-request');
});
