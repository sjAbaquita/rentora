<?php

namespace App\Domains\Notification\Actions;

use App\Domains\Notification\Models\PortalNotification;
use Illuminate\Support\Facades\DB;

class DeleteNotificationAction
{
    public function handle(PortalNotification $notification): void
    {
        DB::transaction(function () use ($notification) {
            $notification->delete();
        });
    }
}
