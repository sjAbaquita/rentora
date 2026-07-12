<?php

namespace Tests\Feature;

use App\Domains\Payment\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_payment_module_to_authenticated_verified_users(): void
    {
        /** @var User $user */
        $user = User::factory()->create(['role' => User::ROLE_OWNER]);
        $payment = Payment::factory()->create();

        $this->actingAs($user)
            ->get('/payments')
            ->assertOk()
            ->assertSee('Payments')
            ->assertSee($payment->reference_number);
    }
}