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
});

// Employee Routes
Route::middleware('can:isEmployee')->group(function() {
    Route::get('/employee/db', [\App\Http\Controllers\Employee\EmployeeDashboardController::class, 'index'])
        ->name('employee.dashboard');
});

