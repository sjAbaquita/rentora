<?php

namespace App\Domains\Organization\Services;

use App\Domains\Organization\Models\Organization;
use Illuminate\Pagination\LengthAwarePaginator;

class OrganizationService
{
    public function getOrganizations(int $perPage = 15): LengthAwarePaginator
    {
        return Organization::withCount('users')->latest()->paginate($perPage);
    }

    public function getOrganizationById(int $id): ?Organization
    {
        return Organization::with('users')->find($id);
    }
}
