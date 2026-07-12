<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_property_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => \App\Models\User::ROLE_OWNER]);
        $property = \App\Domains\Property\Models\Property::factory()->create(['name' => 'Aurora Residences']);
        \App\Domains\Property\Models\Property::factory()->create(['name' => 'North Gate Building']);

        $this->actingAs($user)
            ->get('/properties')
            ->assertOk()
            ->assertSee('Properties')
            ->assertSee($property->name);
    }
}