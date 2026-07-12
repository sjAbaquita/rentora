<?php

namespace App\Domains\Property\Services;

use App\Domains\Property\Models\Property;
use Illuminate\Pagination\LengthAwarePaginator;

class PropertyService
{
    /**
     * Get paginated properties with unit count.
     */
    public function getProperties(?string $search = null, int $perPage = 10): LengthAwarePaginator
	{
		return Property::query()
			->select([
				'id',
				'name',
				'address',
				'city',
				'property_type',
				'status',
				'created_at',
			])
			->withCount('units')
			->when($search !== '', function ($query) use ($search) {
				$query->where('name', 'like', "{$search}%");
			})
			->latest('id')
			->paginate($perPage)
			->withQueryString();
	}

    /**
     * Get property by ID with relationships.
     */
    public function getPropertyById(int $id): ?Property
    {
        return Property::with('units')->find($id);
    }

    /**
     * Get occupancy statistics for dashboard cards.
     *
     * @return array<string, int>
     */
    public function getOccupancyStats(): array
    {
        return [
            'total' => Property::count(),
            'active' => Property::where('status', 'active')->count(),
            'maintenance' => Property::where('status', 'maintenance')->count(),
            'total_units' => Property::sum('total_units'),
        ];
    }
}
