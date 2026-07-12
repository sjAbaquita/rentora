<?php

namespace App\Domains\Maintenance\Models;

use App\Domains\Maintenance\Enums\MaintenancePriority;
use App\Domains\Maintenance\Enums\MaintenanceStatus;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRequest extends Model
{
    /** @use HasFactory<\Database\Factories\MaintenanceRequestFactory> */
    use HasFactory;

    protected $table = 'maintenance';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'unit_id',
        'title',
        'description',
        'priority',
        'status',
        'assigned_to',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'priority' => MaintenancePriority::class,
            'status' => MaintenanceStatus::class,
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function markInProgress(): void
    {
        $this->status = MaintenanceStatus::InProgress;
        $this->save();
    }

    public function markCompleted(): void
    {
        $this->status = MaintenanceStatus::Completed;
        $this->save();
    }
}