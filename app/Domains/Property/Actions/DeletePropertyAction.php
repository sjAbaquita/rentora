<?php

namespace App\Domains\Property\Actions;

use App\Domains\Property\Models\Property;
use Illuminate\Support\Facades\DB;

class DeletePropertyAction
{
    /**
     * Delete a property
     */
    public function handle(Property $property): void
    {
        DB::transaction(function () use ($property) {
            $property->delete();
        });
    }
}
