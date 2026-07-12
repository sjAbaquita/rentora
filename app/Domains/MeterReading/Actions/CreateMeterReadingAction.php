<?php

namespace App\Domains\MeterReading\Actions;

use App\Domains\MeterReading\Models\MeterReading;
use Illuminate\Support\Facades\DB;

class CreateMeterReadingAction
{
    public function handle(array $validatedData): MeterReading
    {
        return DB::transaction(function () use ($validatedData) {
            return MeterReading::create($validatedData);
        });
    }
}
