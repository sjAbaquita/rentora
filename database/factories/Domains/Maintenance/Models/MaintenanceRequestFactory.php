<?php

namespace Database\Factories\Domains\Maintenance\Models;

use App\Domains\Maintenance\Enums\MaintenancePriority;
use App\Domains\Maintenance\Enums\MaintenanceStatus;
use App\Domains\Maintenance\Models\MaintenanceRequest;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MaintenanceRequest>
 */
class MaintenanceRequestFactory extends Factory
{
    protected $model = MaintenanceRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'unit_id' => Unit::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement(MaintenancePriority::cases()),
            'status' => fake()->randomElement(MaintenanceStatus::cases()),
            'assigned_to' => fake()->optional()->name(),
        ];
    }
}
