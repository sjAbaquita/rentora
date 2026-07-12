<?php

namespace Database\Factories\Domains\Expense\Models;

use App\Domains\Expense\Enums\ExpenseCategory;
use App\Domains\Expense\Models\Expense;
use App\Domains\Property\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'expense_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'category' => fake()->randomElement(ExpenseCategory::cases()),
            'description' => fake()->sentence(),
            'amount' => fake()->randomFloat(2, 100, 50000),
            'reference_number' => fake()->optional()->bothify('REF-####'),
        ];
    }
}
