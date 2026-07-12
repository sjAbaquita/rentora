<?php

namespace App\Domains\Notification\Actions;

use App\Domains\Notification\Models\PortalNotification;
use Illuminate\Support\Facades\DB;

class CreateNotificationAction
{
    public function handle(array $validatedData): PortalNotification
    {
        return DB::transaction(function () use ($validatedData) {
            return PortalNotification::create($validatedData);
        });
    }
}
