<?php

namespace App\Domains\MeterReading\Actions;

use App\Domains\MeterReading\Models\MeterReading;
use Illuminate\Support\Facades\DB;

class UpdateMeterReadingAction
{
    public function handle(MeterReading $meterReading, array $validatedData): MeterReading
    {
        return DB::transaction(function () use ($meterReading, $validatedData) {
            $meterReading->update($validatedData);
            return $meterReading->refresh();
        });
    }
}
