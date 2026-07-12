<?php

namespace App\Domains\Property\Services;

use App\Domains\Property\Models\Property;
use Illuminate\Database\Eloquent\Collection;

class PropertyOverviewService
{
    /**
     * Get all properties
     */
    public function getProperties(): Collection
    {
        return Property::all();
    }

    /**
     * Get property by ID
     */
    public function getPropertyById(int $id): ?Property
    {
        return Property::find($id);
    }
}
