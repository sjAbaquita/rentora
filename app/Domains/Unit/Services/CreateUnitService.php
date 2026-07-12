<?php

namespace App\Domains\Unit\Services;

use App\Domains\Unit\Models\Unit;
use App\Domains\Unit\Requests\StoreUnitRequest;
use App\Domains\Unit\Requests\UpdateUnitRequest;

class CreateUnitService
{
    /**
     * @param StoreUnitRequest $request
     * @return Unit
     */
    public function store(StoreUnitRequest $request): Unit
    {
        return Unit::create($request->validated());
    }

    /**
     * @param Unit $unit
     * @param UpdateUnitRequest $request
     * @return Unit
     */
    public function update(Unit $unit, UpdateUnitRequest $request): Unit
    {
        $unit->update($request->validated());

        return $unit;
    }

    /**
     * @param Unit $unit
     * @return bool|null
     */
    public function destroy(Unit $unit): ?bool
    {
        return $unit->delete();
    }
}
