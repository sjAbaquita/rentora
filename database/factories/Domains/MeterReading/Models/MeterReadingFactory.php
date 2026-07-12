<?php

namespace Database\Factories\Domains\MeterReading\Models;

use App\Domains\MeterReading\Enums\MeterReadingType;
use App\Domains\MeterReading\Models\MeterReading;
use App\Domains\Property\Models\Property;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MeterReading>
 */
class MeterReadingFactory extends Factory
{
    protected $model = MeterReading::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $previous = fake()->randomFloat(2, 0, 10000);
        $current = $previous + fake()->randomFloat(2, 10, 1000);

        return [
            'property_id' => Property::factory(),
            'unit_id' => Unit::factory(),
            'reading_type' => fake()->randomElement(MeterReadingType::cases()),
            'previous_reading' => $previous,
            'current_reading' => $current,
            'recorded_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
