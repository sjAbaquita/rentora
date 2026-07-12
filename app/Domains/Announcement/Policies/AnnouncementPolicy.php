<?php

namespace App\Domains\Announcement\Policies;

use App\Domains\Announcement\Models\Announcement;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class AnnouncementPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Announcement $announcement): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Announcement $announcement): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Announcement $announcement): bool
    {
        return self::isOwner($user);
    }
}
