<?php

namespace Tests\Feature;

use App\Domains\MeterReading\Models\MeterReading;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MeterReadingModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_meter_reading_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $meterReading = MeterReading::factory()->create();

        $this->actingAs($user)
            ->get('/meter-readings')
            ->assertOk()
            ->assertSee('Meter Readings')
            ->assertSee($meterReading->reading_type->value);
    }
}