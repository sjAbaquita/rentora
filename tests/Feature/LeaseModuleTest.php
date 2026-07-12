<?php

namespace Tests\Feature;

use App\Domains\Lease\Models\Lease;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaseModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_lease_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $lease = Lease::factory()->create();

        $this->actingAs($user)
            ->get('/leases')
            ->assertOk()
            ->assertSee('Leases')
            ->assertSee($lease->tenant->fullName());
    }
}