<?php

namespace App\Domains\Property\Models;

use App\Domains\Property\Enums\PropertyStatus;
use App\Domains\Property\Enums\PropertyType;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'property_type',
        'total_units',
        'year_built',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'property_type' => PropertyType::class,
            'status' => PropertyStatus::class,
            'total_units' => 'integer',
            'year_built' => 'integer',
        ];
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}