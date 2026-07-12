<?php

namespace Database\Factories\Domains\Announcement\Models;

use App\Domains\Announcement\Enums\AnnouncementPriority;
use App\Domains\Announcement\Enums\AnnouncementStatus;
use App\Domains\Announcement\Models\Announcement;
use App\Domains\Property\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Announcement>
 */
class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'title' => fake()->sentence(5),
            'content' => fake()->paragraph(),
            'priority' => fake()->randomElement(AnnouncementPriority::cases()),
            'status' => fake()->randomElement(AnnouncementStatus::cases()),
            'publish_at' => fake()->optional()->dateTimeBetween('-1 month', '+1 week'),
            'audience' => fake()->randomElement(['All tenants', 'Owners', 'Staff']),
        ];
    }
}
