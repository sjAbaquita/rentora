<?php

namespace Database\Factories\Domains\Payment\Models;

use App\Domains\Invoice\Models\Invoice;
use App\Domains\Payment\Enums\PaymentMethod;
use App\Domains\Payment\Models\Payment;
use App\Domains\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'tenant_id' => Tenant::factory(),
            'reference_number' => 'PAY-'.fake()->unique()->numberBetween(1000, 9999),
            'method' => fake()->randomElement(PaymentMethod::cases()),
            'paid_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'amount' => fake()->randomFloat(2, 1000, 50000),
            'proof_status' => fake()->randomElement(['pending', 'verified', 'rejected']),
        ];
    }
}
