<?php

namespace App\Domains\Unit\Policies;

use App\Domains\Shared\Policies\BasePolicy;
use App\Domains\Unit\Models\Unit;
use App\Models\User;

class UnitPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Unit $unit): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Unit $unit): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Unit $unit): bool
    {
        return self::isOwner($user);
    }
}
