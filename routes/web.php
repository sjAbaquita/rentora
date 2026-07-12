<?php

use App\Domains\Property\Controllers\PropertyController;
use App\Domains\Lease\Controllers\LeaseController;
use App\Domains\Invoice\Controllers\InvoiceController;
use App\Domains\Payment\Controllers\PaymentController;
use App\Domains\Maintenance\Controllers\MaintenanceController;
use App\Domains\Document\Controllers\DocumentController;
use App\Domains\Expense\Controllers\ExpenseController;
use App\Domains\Announcement\Controllers\AnnouncementController;
use App\Domains\Report\Controllers\ReportController;
use App\Domains\MeterReading\Controllers\MeterReadingController;
use App\Domains\Notification\Controllers\NotificationController;
use App\Domains\TenantPortal\Controllers\TenantPortalController;
use App\Domains\PaymentIntegration\Controllers\PaymentIntegrationController;
use App\Domains\Organization\Controllers\OrganizationController;
use App\Domains\Tenant\Controllers\TenantController;
use App\Domains\Unit\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    // CRUD resources
    Route::resource('properties', PropertyController::class);
    Route::resource('leases', LeaseController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('maintenance', MaintenanceController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('tenants', TenantController::class);
    Route::resource('units', UnitController::class);
    Route::resource('meter-readings', MeterReadingController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('organization', OrganizationController::class);

    // Overview-only routes (no CRUD)
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('tenant-portal', [TenantPortalController::class, 'index'])->name('tenant-portal.index');
    Route::get('payment-integrations', [PaymentIntegrationController::class, 'index'])->name('payment-integrations.index');
});

require __DIR__.'/settings.php';
