<?php

namespace App\Domains\Property\Services;

use App\Domains\Property\Models\Property;
use App\Domains\Property\Requests\StorePropertyRequest;
use App\Domains\Property\Requests\UpdatePropertyRequest;

class CreatePropertyService
{
    /**
     * @param StorePropertyRequest $request
     * @return Property
     */
    public function store(StorePropertyRequest $request): Property
    {
        return Property::create($request->validated());
    }

    /**
     * @param Property $property
     * @param UpdatePropertyRequest $request
     * @return Property
     */
    public function update(Property $property, UpdatePropertyRequest $request): Property
    {
        $property->update($request->validated());

        return $property;
    }

    /**
     * @param Property $property
     * @return bool|null
     */
    public function destroy(Property $property): ?bool
    {
        return $property->delete();
    }
}
