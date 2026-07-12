<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PaymentIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_payment_integration_to_authenticated_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);

        $this->actingAs($user)
            ->get('/payment-integrations')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('payment-integration/Index')
                ->has('summaryCards', 4)
                ->has('gateways', 3)
                ->has('integrations', 3)
                ->where('gateways.0.label', 'GCash')
                ->where('integrations.0.gateway', 'GCash')
            );
    }
}
