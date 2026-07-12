<?php

namespace Database\Factories\Domains\Organization\Models;

use App\Domains\Organization\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Organization>
 */
class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name.'-'.fake()->unique()->numberBetween(1, 9999)),
            'billing_email' => fake()->companyEmail(),
            'country' => fake()->country(),
            'timezone' => fake()->randomElement(['UTC', 'Asia/Manila', 'America/New_York', 'Europe/London']),
        ];
    }
}
