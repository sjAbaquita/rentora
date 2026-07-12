<?php

namespace App\Domains\MeterReading\Actions;

use App\Domains\MeterReading\Models\MeterReading;
use Illuminate\Support\Facades\DB;

class DeleteMeterReadingAction
{
    public function handle(MeterReading $meterReading): void
    {
        DB::transaction(function () use ($meterReading) {
            $meterReading->delete();
        });
    }
}
