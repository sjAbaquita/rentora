<?php

namespace App\Domains\Notification\Policies;

use App\Domains\Notification\Models\PortalNotification;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class NotificationPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, PortalNotification $notification): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, PortalNotification $notification): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, PortalNotification $notification): bool
    {
        return self::isOwner($user);
    }
}
