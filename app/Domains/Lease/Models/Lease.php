<?php

namespace App\Domains\Lease\Models;

use App\Domains\Invoice\Models\Invoice;
use App\Domains\Lease\Enums\LeaseStatus;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lease extends Model
{
    /** @use HasFactory<\Database\Factories\LeaseFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'unit_id',
        'tenant_id',
        'lease_start',
        'lease_end',
        'monthly_rent',
        'deposit',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'lease_start' => 'date',
            'lease_end' => 'date',
            'deposit' => 'decimal:2',
            'monthly_rent' => 'decimal:2',
            'status' => LeaseStatus::class,
        ];
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function isActive(): bool
    {
        return $this->status === LeaseStatus::Active
            && $this->lease_start->isPast()
            && $this->lease_end->isFuture();
    }
}