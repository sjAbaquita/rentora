<?php

namespace Database\Factories\Domains\Lease\Models;

use App\Domains\Lease\Enums\LeaseStatus;
use App\Domains\Lease\Models\Lease;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lease>
 */
class LeaseFactory extends Factory
{
    protected $model = Lease::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 year', '+1 month');
        $end = (clone $start)->modify('+'.fake()->numberBetween(6, 24).' months');

        return [
            'unit_id' => Unit::factory(),
            'tenant_id' => Tenant::factory(),
            'lease_start' => $start->format('Y-m-d'),
            'lease_end' => $end->format('Y-m-d'),
            'monthly_rent' => fake()->randomFloat(2, 5000, 50000),
            'deposit' => fake()->randomFloat(2, 5000, 100000),
            'status' => fake()->randomElement(LeaseStatus::cases()),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'lease_start' => now()->subMonths(2)->format('Y-m-d'),
            'lease_end' => now()->addMonths(10)->format('Y-m-d'),
            'status' => LeaseStatus::Active,
        ]);
    }
}
