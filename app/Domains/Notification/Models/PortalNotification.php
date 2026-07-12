<?php

namespace App\Domains\Notification\Models;

use App\Domains\Notification\Enums\NotificationChannel;
use App\Domains\Notification\Enums\NotificationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalNotification extends Model
{
    /** @use HasFactory<\Database\Factories\PortalNotificationFactory> */
    use HasFactory;

    protected $table = 'notifications';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'channel',
        'recipient',
        'sent_at',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'channel' => NotificationChannel::class,
            'status' => NotificationStatus::class,
        ];
    }

    public function markSent(): void
    {
        $this->status = NotificationStatus::Sent;
        $this->sent_at = now();
        $this->save();
    }

    public function markRead(): void
    {
        $this->status = NotificationStatus::Read;
        $this->save();
    }
}