<?php

namespace Tests\Feature;

use App\Domains\Unit\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_unit_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $unit = Unit::factory()->create();

        $this->actingAs($user)
            ->get('/units')
            ->assertOk()
            ->assertSee('Units')
            ->assertSee($unit->unit_number);
    }
}