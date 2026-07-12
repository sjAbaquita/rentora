<?php

namespace App\Domains\Unit\Services;

use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UnitService
{
    public function getUnits(int $perPage = 15): LengthAwarePaginator
    {
        return Unit::with('property')->latest()->paginate($perPage);
    }

    public function getUnitById(int $id): ?Unit
    {
        return Unit::with(['property', 'leases.tenant'])->find($id);
    }

    public function getAvailableUnits(): Collection
    {
        return Unit::where('status', 'available')->get();
    }

    /**
     * @return array<string, int>
     */
    public function getStatusStats(): array
    {
        return [
            'total' => Unit::count(),
            'available' => Unit::where('status', 'available')->count(),
            'occupied' => Unit::where('status', 'occupied')->count(),
            'maintenance' => Unit::where('status', 'maintenance')->count(),
        ];
    }
}
