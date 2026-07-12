<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class TenantPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_tenant_portal_to_authenticated_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);

        $this->actingAs($user)
            ->get('/tenant-portal')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('tenant-portal/Index')
                ->has('tenantProfile')
                ->has('recentInvoices', 3)
                ->has('recentPayments', 3)
                ->has('activeAnnouncements', 2)
                ->has('maintenanceRequests', 2)
            );
    }
}
