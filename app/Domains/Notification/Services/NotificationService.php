<?php

namespace App\Domains\Notification\Services;

use App\Domains\Notification\Models\PortalNotification;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationService
{
    public function getNotifications(int $perPage = 15): LengthAwarePaginator
    {
        return PortalNotification::latest('sent_at')->paginate($perPage);
    }

    public function getNotificationById(int $id): ?PortalNotification
    {
        return PortalNotification::find($id);
    }

    /**
     * @return array<string, int>
     */
    public function getStats(): array
    {
        return [
            'total' => PortalNotification::count(),
            'pending' => PortalNotification::where('status', 'pending')->count(),
            'sent' => PortalNotification::where('status', 'sent')->count(),
        ];
    }
}
