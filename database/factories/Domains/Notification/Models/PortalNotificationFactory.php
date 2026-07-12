<?php

namespace Database\Factories\Domains\Notification\Models;

use App\Domains\Notification\Enums\NotificationChannel;
use App\Domains\Notification\Enums\NotificationStatus;
use App\Domains\Notification\Models\PortalNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortalNotification>
 */
class PortalNotificationFactory extends Factory
{
    protected $model = PortalNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'channel' => fake()->randomElement(NotificationChannel::cases()),
            'recipient' => fake()->randomElement(['All tenants', 'Maria Santos', 'Jun Reyes', 'North Gate Building']),
            'sent_at' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'status' => fake()->randomElement(NotificationStatus::cases()),
        ];
    }
}
