<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class NotificationModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_notification_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);

        $this->actingAs($user)
            ->get('/notifications')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('notification/Index')
                ->has('summaryCards', 4)
                ->has('channels', 3)
                ->has('notifications', 4)
                ->where('channels.0.label', 'Email')
                ->where('notifications.0.title', 'Rent reminder sent')
            );
    }
}