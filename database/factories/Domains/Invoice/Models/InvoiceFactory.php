<?php

namespace Database\Factories\Domains\Invoice\Models;

use App\Domains\Invoice\Enums\InvoiceStatus;
use App\Domains\Invoice\Models\Invoice;
use App\Domains\Lease\Models\Lease;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amountDue = fake()->randomFloat(2, 5000, 50000);

        return [
            'lease_id' => Lease::factory(),
            'invoice_number' => 'INV-'.fake()->unique()->numberBetween(1000, 9999),
            'billing_period' => fake()->date('F Y'),
            'due_date' => fake()->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'amount_due' => $amountDue,
            'amount_paid' => fake()->randomElement([0, $amountDue, fake()->randomFloat(2, 1000, $amountDue)]),
            'late_fee' => fake()->randomFloat(2, 0, 1000),
            'status' => fake()->randomElement(InvoiceStatus::cases()),
            'description' => fake()->sentence(),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => InvoiceStatus::Pending,
            'amount_paid' => 0,
        ]);
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => InvoiceStatus::Paid,
            'amount_paid' => $attributes['amount_due'],
        ]);
    }
}
