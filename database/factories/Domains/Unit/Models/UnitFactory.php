<?php

namespace Database\Factories\Domains\Unit\Models;

use App\Domains\Property\Models\Property;
use App\Domains\Unit\Enums\UnitStatus;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Unit>
 */
class UnitFactory extends Factory
{
    protected $model = Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'unit_number' => fake()->bothify('?-####'),
            'unit_type' => fake()->randomElement(['Studio', '1 Bedroom', '2 Bedroom', '3 Bedroom', 'Penthouse']),
            'floor_number' => fake()->numberBetween(1, 30),
            'area_sqm' => fake()->randomFloat(2, 20, 200),
            'bedrooms' => fake()->numberBetween(0, 4),
            'bathrooms' => fake()->numberBetween(1, 3),
            'status' => fake()->randomElement(UnitStatus::cases()),
        ];
    }

    public function available(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => UnitStatus::Available,
        ]);
    }

    public function occupied(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => UnitStatus::Occupied,
        ]);
    }
}
