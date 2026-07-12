<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Models\Unit;
use Illuminate\Support\Facades\DB;

class CreateUnitAction
{
    public function handle(array $validatedData): Unit
    {
        return DB::transaction(function () use ($validatedData) {
            return Unit::create($validatedData);
        });
    }
}
