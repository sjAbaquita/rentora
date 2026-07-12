<?php

namespace App\Domains\Property\Actions;

use App\Domains\Property\Models\Property;
use Illuminate\Support\Facades\DB;

class UpdatePropertyAction
{
    /**
     * Update an existing property
     */
    public function handle(Property $property, array $validatedData): Property
    {
        return DB::transaction(function () use ($property, $validatedData) {
            $property->update($validatedData);
            return $property->refresh();
        });
    }
}
