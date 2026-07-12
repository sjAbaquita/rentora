<?php

namespace App\Domains\Lease\Services;

use App\Domains\Lease\Models\Lease;
use Illuminate\Pagination\LengthAwarePaginator;

class LeaseService
{
    public function getLeases(int $perPage = 15): LengthAwarePaginator
    {
        return Lease::with(['unit.property', 'tenant'])->latest()->paginate($perPage);
    }

    public function getLeaseById(int $id): ?Lease
    {
        return Lease::with(['unit.property', 'tenant', 'invoices'])->find($id);
    }

    /**
     * @return array<string, int>
     */
    public function getStats(): array
    {
        return [
            'total' => Lease::count(),
            'active' => Lease::where('status', 'active')->count(),
            'ending_soon' => Lease::where('status', 'active')
                ->where('lease_end', '<=', now()->addMonth())
                ->count(),
        ];
    }
}
