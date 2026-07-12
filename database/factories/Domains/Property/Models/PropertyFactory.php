<?php

namespace Database\Factories\Domains\Property\Models;

use App\Domains\Property\Enums\PropertyStatus;
use App\Domains\Property\Enums\PropertyType;
use App\Domains\Property\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company().' Residences',
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'property_type' => fake()->randomElement(PropertyType::cases()),
            'total_units' => fake()->numberBetween(1, 50),
            'year_built' => fake()->numberBetween(1990, 2024),
            'status' => fake()->randomElement(PropertyStatus::cases()),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => PropertyStatus::Active,
        ]);
    }
}
