<?php

namespace App\Domains\MeterReading\Services;

use App\Domains\MeterReading\Models\MeterReading;
use Illuminate\Pagination\LengthAwarePaginator;

class MeterReadingService
{
    public function getMeterReadings(int $perPage = 15): LengthAwarePaginator
    {
        return MeterReading::with(['property', 'unit'])->latest('recorded_at')->paginate($perPage);
    }

    public function getMeterReadingById(int $id): ?MeterReading
    {
        return MeterReading::with(['property', 'unit'])->find($id);
    }
}
