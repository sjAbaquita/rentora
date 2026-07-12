<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Models\Unit;
use Illuminate\Support\Facades\DB;

class DeleteUnitAction
{
    public function handle(Unit $unit): void
    {
        DB::transaction(function () use ($unit) {
            $unit->delete();
        });
    }
}
