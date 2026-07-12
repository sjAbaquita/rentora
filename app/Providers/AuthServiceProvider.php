<?php

namespace App\Providers;

use App\Domains\Announcement\Models\Announcement;
use App\Domains\Announcement\Policies\AnnouncementPolicy;
use App\Domains\Document\Models\Document;
use App\Domains\Document\Policies\DocumentPolicy;
use App\Domains\Expense\Models\Expense;
use App\Domains\Expense\Policies\ExpensePolicy;
use App\Domains\Invoice\Models\Invoice;
use App\Domains\Invoice\Policies\InvoicePolicy;
use App\Domains\Lease\Models\Lease;
use App\Domains\Lease\Policies\LeasePolicy;
use App\Domains\Maintenance\Models\MaintenanceRequest;
use App\Domains\Maintenance\Policies\MaintenancePolicy;
use App\Domains\MeterReading\Models\MeterReading;
use App\Domains\MeterReading\Policies\MeterReadingPolicy;
use App\Domains\Notification\Models\PortalNotification;
use App\Domains\Notification\Policies\NotificationPolicy;
use App\Domains\Organization\Models\Organization;
use App\Domains\Organization\Policies\OrganizationPolicy;
use App\Domains\Payment\Models\Payment;
use App\Domains\Payment\Policies\PaymentPolicy;
use App\Domains\Property\Models\Property;
use App\Domains\Property\Policies\PropertyPolicy;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Tenant\Policies\TenantPolicy;
use App\Domains\Unit\Models\Unit;
use App\Domains\Unit\Policies\UnitPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Property::class => PropertyPolicy::class,
        Unit::class => UnitPolicy::class,
        Tenant::class => TenantPolicy::class,
        Lease::class => LeasePolicy::class,
        Invoice::class => InvoicePolicy::class,
        Payment::class => PaymentPolicy::class,
        MaintenanceRequest::class => MaintenancePolicy::class,
        Expense::class => ExpensePolicy::class,
        Announcement::class => AnnouncementPolicy::class,
        Document::class => DocumentPolicy::class,
        MeterReading::class => MeterReadingPolicy::class,
        PortalNotification::class => NotificationPolicy::class,
        Organization::class => OrganizationPolicy::class,
    ];

    public function boot(): void
    {
        Gate::define('view-reports', static function ($user): bool {
            return $user->isOwner() || $user->isStaff();
        });

        Gate::define('access-tenant-portal', static function ($user): bool {
            return $user->isTenant() || $user->isOwner();
        });
    }
}
