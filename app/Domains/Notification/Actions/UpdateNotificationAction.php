<?php

namespace App\Domains\Notification\Actions;

use App\Domains\Notification\Models\PortalNotification;
use Illuminate\Support\Facades\DB;

class UpdateNotificationAction
{
    public function handle(PortalNotification $notification, array $validatedData): PortalNotification
    {
        return DB::transaction(function () use ($notification, $validatedData) {
            $notification->update($validatedData);
            return $notification->refresh();
        });
    }
}
