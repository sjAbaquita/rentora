<?php

namespace Tests\Feature;

use App\Domains\Maintenance\Models\MaintenanceRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaintenanceModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_maintenance_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $maintenance = MaintenanceRequest::factory()->create();

        $this->actingAs($user)
            ->get('/maintenance')
            ->assertOk()
            ->assertSee('Maintenance')
            ->assertSee($maintenance->title);
    }
}