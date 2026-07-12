<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Models\Unit;
use Illuminate\Support\Facades\DB;

class UpdateUnitAction
{
    public function handle(Unit $unit, array $validatedData): Unit
    {
        return DB::transaction(function () use ($unit, $validatedData) {
            $unit->update($validatedData);
            return $unit->refresh();
        });
    }
}
