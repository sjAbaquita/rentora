<?php

namespace Tests\Feature;

use App\Domains\Announcement\Models\Announcement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnnouncementModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_announcement_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $announcement = Announcement::factory()->create();

        $this->actingAs($user)
            ->get('/announcements')
            ->assertOk()
            ->assertSee('Announcements')
            ->assertSee($announcement->title);
    }
}