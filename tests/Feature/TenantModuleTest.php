<?php

namespace Tests\Feature;

use App\Domains\Tenant\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_tenant_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $tenant = Tenant::factory()->create();

        $this->actingAs($user)
            ->get('/tenants')
            ->assertOk()
            ->assertSee('Tenants')
            ->assertSee($tenant->fullName());
    }
}