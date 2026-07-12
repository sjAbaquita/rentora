<?php

namespace App\Domains\Announcement\Models;

use App\Domains\Announcement\Enums\AnnouncementPriority;
use App\Domains\Announcement\Enums\AnnouncementStatus;
use App\Domains\Property\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    /** @use HasFactory<\Database\Factories\AnnouncementFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'title',
        'content',
        'priority',
        'audience',
        'publish_at',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'publish_at' => 'datetime',
            'status' => AnnouncementStatus::class,
            'priority' => AnnouncementPriority::class,
        ];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', AnnouncementStatus::Published)
            ->where('publish_at', '<=', now());
    }
}