<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_report_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);

        $this->actingAs($user)
            ->get('/reports')
            ->assertOk()
            ->assertSee('Reports');
    }
}