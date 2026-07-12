<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_organization_to_authenticated_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);

        $this->actingAs($user)
            ->get('/organization')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('organization/Index')
                ->has('summaryCards', 4)
                ->has('organization')
                ->has('teamMembers', 3)
                ->has('billingInfo')
            );
    }
}
