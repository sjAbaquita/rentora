<?php

namespace App\Domains\Lease\Actions;

use App\Domains\Lease\Models\Lease;
use App\Domains\Unit\Enums\UnitStatus;
use App\Domains\Unit\Models\Unit;
use Illuminate\Support\Facades\DB;

class UpdateLeaseAction
{
    public function handle(Lease $lease, array $validatedData): Lease
    {
        return DB::transaction(function () use ($lease, $validatedData) {
            $originalUnitId = $lease->unit_id;
            $lease->update($validatedData);
            $lease->refresh();

            if ($lease->status->value === 'active') {
                Unit::where('id', $lease->unit_id)->update(['status' => UnitStatus::Occupied]);

                if ($originalUnitId !== $lease->unit_id) {
                    Unit::where('id', $originalUnitId)->update(['status' => UnitStatus::Available]);
                }
            }

            return $lease;
        });
    }
}
