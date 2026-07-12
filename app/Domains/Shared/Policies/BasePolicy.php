<?php

namespace App\Domains\Shared\Policies;

use App\Models\User;

abstract class BasePolicy
{
    protected static function isOwner(User $user): bool
    {
        return $user->isOwner();
    }

    protected static function isStaffOrOwner(User $user): bool
    {
        return $user->isOwner() || $user->isStaff();
    }

    protected static function isTenant(User $user): bool
    {
        return $user->isTenant();
    }
}
