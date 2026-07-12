<?php

namespace App\Domains\Lease\Actions;

use App\Domains\Lease\Models\Lease;
use App\Domains\Unit\Enums\UnitStatus;
use App\Domains\Unit\Models\Unit;
use Illuminate\Support\Facades\DB;

class DeleteLeaseAction
{
    public function handle(Lease $lease): void
    {
        DB::transaction(function () use ($lease) {
            $unitId = $lease->unit_id;
            $lease->delete();
            Unit::where('id', $unitId)->update(['status' => UnitStatus::Available]);
        });
    }
}
