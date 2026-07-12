<?php

namespace App\Domains\MeterReading\Models;

use App\Domains\MeterReading\Enums\MeterReadingType;
use App\Domains\Property\Models\Property;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeterReading extends Model
{
    /** @use HasFactory<\Database\Factories\MeterReadingFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'unit_id',
        'reading_type',
        'previous_reading',
        'current_reading',
        'recorded_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
            'reading_type' => MeterReadingType::class,
            'previous_reading' => 'decimal:2',
            'current_reading' => 'decimal:2',
        ];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function consumption(): float
    {
        return (float) $this->current_reading - (float) $this->previous_reading;
    }
}