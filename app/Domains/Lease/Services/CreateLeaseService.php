<?php

namespace App\Domains\Lease\Services;

use App\Domains\Lease\Models\Lease;
use App\Domains\Lease\Requests\StoreLeaseRequest;
use App\Domains\Lease\Requests\UpdateLeaseRequest;

class CreateLeaseService
{
    /**
     * @param StoreLeaseRequest $request
     * @return Lease
     */
    public function store(StoreLeaseRequest $request): Lease
    {
        return Lease::create($request->validated());
    }

    /**
     * @param Lease $lease
     * @param UpdateLeaseRequest $request
     * @return Lease
     */
    public function update(Lease $lease, UpdateLeaseRequest $request): Lease
    {
        $lease->update($request->validated());

        return $lease;
    }

    /**
     * @param Lease $lease
     * @return bool|null
     */
    public function destroy(Lease $lease): ?bool
    {
        return $lease->delete();
    }
}
