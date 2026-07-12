<?php

namespace App\Domains\Lease\Actions;

use App\Domains\Lease\Models\Lease;
use App\Domains\Unit\Enums\UnitStatus;
use App\Domains\Unit\Models\Unit;
use Illuminate\Support\Facades\DB;

class CreateLeaseAction
{
    public function handle(array $validatedData): Lease
    {
        return DB::transaction(function () use ($validatedData) {
            $lease = Lease::create($validatedData);

            if ($lease->status->value === 'active') {
                Unit::where('id', $lease->unit_id)->update(['status' => UnitStatus::Occupied]);
            }

            return $lease;
        });
    }
}
