<?php

namespace App\Domains\Unit\Models;

use App\Domains\Lease\Models\Lease;
use App\Domains\Property\Models\Property;
use App\Domains\Unit\Enums\UnitStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'unit_number',
        'unit_type',
        'floor_number',
        'area_sqm',
        'bedrooms',
        'bathrooms',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => UnitStatus::class,
            'floor_number' => 'integer',
            'bedrooms' => 'integer',
            'bathrooms' => 'integer',
            'area_sqm' => 'decimal:2',
        ];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }

    public function currentLease(): ?Lease
    {
        return $this->leases()
            ->where('status', 'active')
            ->where('lease_start', '<=', now())
            ->where('lease_end', '>=', now())
            ->first();
    }
}