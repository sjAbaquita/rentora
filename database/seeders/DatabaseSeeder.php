<?php

namespace Database\Seeders;

use App\Domains\Announcement\Models\Announcement;
use App\Domains\Document\Models\Document;
use App\Domains\Expense\Models\Expense;
use App\Domains\Invoice\Models\Invoice;
use App\Domains\Lease\Models\Lease;
use App\Domains\Maintenance\Models\MaintenanceRequest;
use App\Domains\MeterReading\Models\MeterReading;
use App\Domains\Notification\Models\PortalNotification;
use App\Domains\Organization\Models\Organization;
use App\Domains\Payment\Models\Payment;
use App\Domains\Property\Models\Property;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Unit\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $organization = Organization::factory()->create([
            'name' => 'Aurora Properties Inc.',
            'slug' => 'aurora-properties',
            'billing_email' => 'billing@auroraproperties.example.com',
            'country' => 'Philippines',
            'timezone' => 'Asia/Manila',
        ]);

        $owner = User::factory()->create([
            'name' => 'Test Owner',
            'email' => 'owner@example.com',
            'password' => bcrypt('123Password_'),
            'role' => User::ROLE_OWNER,
            'organization_id' => $organization->id,
        ]);

        User::factory()->create([
            'name' => 'Test Staff',
            'email' => 'staff@example.com',
            'password' => bcrypt('123Password_'),
            'role' => User::ROLE_STAFF,
            'organization_id' => $organization->id,
        ]);

        $properties = Property::factory()->count(3)->create([
            'status' => \App\Domains\Property\Enums\PropertyStatus::Active,
        ]);

        $properties->each(function (Property $property): void {
            $units = Unit::factory()->count(4)->create([
                'property_id' => $property->id,
            ]);

            $tenants = Tenant::factory()->count(3)->create();

            $units->each(function (Unit $unit) use ($tenants): void {
                $tenant = $tenants->random();

                $lease = Lease::factory()->create([
                    'unit_id' => $unit->id,
                    'tenant_id' => $tenant->id,
                    'status' => \App\Domains\Lease\Enums\LeaseStatus::Active,
                ]);

                Invoice::factory()->count(2)->create([
                    'lease_id' => $lease->id,
                ]);
            });

            Expense::factory()->count(3)->create([
                'property_id' => $property->id,
            ]);

            Announcement::factory()->count(2)->create([
                'property_id' => $property->id,
            ]);

            Document::factory()->count(2)->create([
                'property_id' => $property->id,
            ]);

            MeterReading::factory()->count(4)->create([
                'property_id' => $property->id,
            ]);
        });

        MaintenanceRequest::factory()->count(5)->create();
        Payment::factory()->count(5)->create();
        PortalNotification::factory()->count(5)->create();

        User::factory()->create([
            'name' => 'Test Tenant',
            'email' => 'tenant@example.com',
            'password' => bcrypt('123Password_'),
            'role' => User::ROLE_TENANT,
            'organization_id' => $organization->id,
        ]);
    }
}
