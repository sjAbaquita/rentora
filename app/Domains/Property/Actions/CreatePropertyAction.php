<?php

namespace App\Domains\Property\Actions;

use App\Domains\Property\Models\Property;
use Illuminate\Support\Facades\DB;

class CreatePropertyAction
{
    /**
     * Create a new property
     */
    public function handle(array $validatedData): Property
    {
        return DB::transaction(function () use ($validatedData) {
            return Property::create($validatedData);
        });
    }
}
