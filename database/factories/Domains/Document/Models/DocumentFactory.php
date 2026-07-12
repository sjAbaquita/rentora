<?php

namespace Database\Factories\Domains\Document\Models;

use App\Domains\Document\Enums\DocumentType;
use App\Domains\Document\Models\Document;
use App\Domains\Property\Models\Property;
use App\Domains\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Document>
 */
class DocumentFactory extends Factory
{
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory(),
            'tenant_id' => fake()->optional(0.5)->passthrough(Tenant::factory()),
            'title' => fake()->sentence(4),
            'document_type' => fake()->randomElement(DocumentType::cases()),
            'file_path' => fake()->optional()->filePath(),
            'description' => fake()->sentence(),
            'uploaded_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
